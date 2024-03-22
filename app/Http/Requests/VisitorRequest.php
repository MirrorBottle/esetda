<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisitorRequest extends FormRequest
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
            'sender' => ['required'],
            'institution' => ['required'],
            'letter_title' => ['required'],
            'receiver_id' => ['required', 'numeric'],
            'attachment' => ['required', 'file', 'max:10240'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sender.required' => 'Nama pengirim wajib diisi',
            'institution.required' => 'Nama institusi wajib diisi',
            'letter_title.required' => 'Judul surat wajib diisi',
            'receiver_id.required' => 'Tujuan surat wajib diisi',
            'attachment.required' => 'Berkas lampiran surat wajib diisi',
            'attachment.file' => 'Berkas lampiran harus dalam bentuk file',
            'attachment.size' => 'Berkas lampiran maksimal kurang dari 10mb',
        ];
    }
}
