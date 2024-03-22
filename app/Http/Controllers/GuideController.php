<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function esurat()
    {
        return view ('guide.esurat');
    }

    public function disposisi()
    {
        return view ('guide.disposisi');
    }
}
