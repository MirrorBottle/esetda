<?php

namespace App\Http\Controllers;

use App\Inbox;
use App\Outbox;
use App\Receipt;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $model = $request->type == 'inbox' ? Inbox::class : Outbox::class;

        if ($request->action == 'new') {
            $surat   = $model::find($request->id);
            $receipt = $surat->receipt()->save(new Receipt($input));
        } else if ($request->action == 'edit') {
            $receipt = Receipt::type($request->type)->where('receiptable_id', $request->id)->first();
            $receipt->update($input);
        }

        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $extension  = $file->getClientOriginalExtension();
            $name       = 'receipt_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

            $check = in_array(strtolower($extension), $allowed);
            if ($check) {
                $file->move(public_path('storage'), $name);
                $receipt->update(['attachment' => $name]);
            }
        }

        // check attachments status
        if ($request->uploaded_file == 'removed') {
            $receipt->update(['attachment' => null]);
        }

        return back()->with('success', 'Berhasil menambah data tanda terima');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        $receipt = Receipt::type($type)->where('receiptable_id', $id)->first();
        return response()->json(['data' => $receipt ?? null]);
    }
}
