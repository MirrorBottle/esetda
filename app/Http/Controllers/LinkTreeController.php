<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\LetterNumberUsed;
use App\LetterNumberUsedBundle;

class LinkTreeController extends Controller
{
    public function agenda($id)
    {
        $agenda = Agenda::with('inbox')->findOrFail($id);

        return view('linktree.agenda', compact('agenda'));
    }

    public function penomoran($id)
    {
        $bundle = LetterNumberUsedBundle::findOrFail($id);
        $data   = LetterNumberUsed::whereIn('id', explode(",", $bundle->list_id))->get();

        return view('linktree.penomoran', compact('bundle', 'data'));
    }
}
