<?php

namespace App\Http\Controllers;

use App\Biro;
use App\Inbox;
use App\Outbox;
use Illuminate\Http\Request;

class RecycleBinController extends Controller
{
    public function index(Request $request)
    {
        $biros   = Biro::pluck('name', 'id');
        $type    = $request->type ?? 'masuk';
        $switch  = $this->selectModel($type);
        $results = $switch['model']::onlyTrashed()->filter($request);

        if ($request->has('biro_id') && $request->biro_id !== null) {
            $results = $results->where('biro_id', $request->biro_id);
        }

        $results = $results->orderBy('id', 'desc')->get();

        return view('recycle.index', compact('biros', 'type', 'results'));

    }

    private function selectModel($type)
    {
        $data = array();
        if ($type == 'masuk') {
            $data = [
                'model' => Inbox::class,
            ];
        } else if ($type == 'keluar') {
            $data = [
                'model' => Outbox::class,
            ];
        }

        return $data;
    }

    public function remove(Request $request)
    {
        $type    = $request->type;
        $list_id = explode(",", $request->list_id);
        $switch  = $this->selectModel($type);
        $models  = $switch['model']::onlyTrashed()->whereIn('id', $list_id)->get();
        foreach ($models as $model) {
            $model->removeRelatedData();
            $model->forceDelete();
        }

        return back()->with('success', 'Berhasil menghapus permanen data surat.');
    }

    public function restore(Request $request)
    {
        $type    = $request->type;
        $list_id = explode(",", $request->list_id);
        $switch  = $this->selectModel($type);
        $models  = $switch['model']::onlyTrashed()->whereIn('id', $list_id)->get();
        foreach ($models as $model) {
            $model->update(['deleted_by' => null]);
            $model->restore();
        }

        return back()->with('success', 'Berhasil mengembalikan data surat.');
    }
}
