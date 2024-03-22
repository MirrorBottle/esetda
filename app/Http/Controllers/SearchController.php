<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Biro;
use App\Inbox;
use App\Forward;
use App\Outbox;
use App\Category;
use App\Pejabat;
use App\User;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $user       = auth()->user();
        $biro_id    = $user->biro_id;
        $biros      = Biro::where('id', '!=', $biro_id)->get();
        $categories = Category::orderBy('name')->get();
        $date       = to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1);

        return view('search.index', compact('user', 'categories', 'biros', 'date'));
    }

    public function result(Request $request)
    {
        $user    = auth()->user();
        $user_id = $user->id;
        $biro_id = $user->biro_id;
        $biros   = Biro::where('id', '!=', $biro_id)->pluck('name', 'id');
        $type    = $this->selectType($request->type);
        $sekdas  = Pejabat::where('type', 0)->get();
        // cek jika user biro maka ambil user id karo nya
        if (substr($user->username, 0, 4) === 'biro') {
            $user = User::where('username', 'like', '%karo%')->where('biro_id', $biro_id)->first();
            $user_id = $user->id;
        }

        // jika biro kosong (admin) hilangkan filter biro
        if ($biro_id === null) {        
            // custom user fahmi
            if ($user->username === 'fahmi') {
                $results = $type['model']::filter($request)
                    ->orderBy('id', 'desc')
                    ->get();
            } else {
                //  filter id tujuan per username admin
                $receiver_id = $user->receiver_id;
                $results = $type['model']::filter($request)
                    ->where('receiver_id', $receiver_id)
                    ->orderBy('id', 'desc')
                    ->get();
            }
        } else {
            $results = $type['model']::filter($request)
                ->orderBy('id', 'desc')
                ->get();
        }

        $data = [
            'biros' => $biros,
            'filter' => $this->filterParam($request->except('_token')),
            'sekdas' => $sekdas,
            'date' => to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1),
            'status_disposisi' => $sekdas[0]->is_ttd_area_reverse,
            'user_id' => $user_id,
            $type['vars'] => $results,
        ];

        return view($type['view'], $data);
    }

    private function selectType($type)
    {
        $data = array();
        if ($type == 'masuk') {
            $data = [
                'model' => Inbox::class,
                'view'  => 'inbox.index',
                'vars'  => 'inboxes',
            ];
        } else if ($type == 'keluar') {
            $data = [
                'model' => Outbox::class,
                'view'  => 'outbox.index',
                'vars'  => 'outboxes',
            ];
        } else if ($type == 'terusan') {
            $data = [
                'model' => Forward::class,
                'view'  => 'forward.index',
                'vars'  => 'forwards',
            ];
        }

        return $data;
    }

    private function filterParam($request)
    {
        $filter = '';
        foreach ($request as $key => $param)
        {
            $filter .= $key .'='. urlencode($param) .'&';
        }

        return substr($filter, 0, -1);
    }
}
