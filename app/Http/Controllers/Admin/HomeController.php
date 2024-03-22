<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ArchiveInfo;

class HomeController extends Controller
{
    public function index()
    {
        $data = array();
        $user_type = auth()->user()->type_formatted;
        if ($user_type == 'earsip') {
            $infos = ArchiveInfo::where('is_archived', 0)->get();
            $data = [
                'all' => 90,
                'monthly' => 10,
                'infos' => $infos
            ];
        }

        return view('admin.dashboard.index', compact('user_type', 'data'));
    }
}
