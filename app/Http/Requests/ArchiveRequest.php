<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArchiveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required',
            'biro_id' => 'required|numeric',
            'surat_id' => 'required|numeric',
            'clasification_id' => 'required',
            'year' => 'required|numeric',
            'date' => 'required|date',
            'tk_prk' => 'required',
            'qty' => 'required|numeric',
            // 'no_box' => 'required|numeric',
            // 'no_folder' => 'required|numeric',
            'condition' => 'required',
            'attachment'  => 'nullable|file|mimes:pdf,jpg,jpeg,png'
        ];
    }
}
