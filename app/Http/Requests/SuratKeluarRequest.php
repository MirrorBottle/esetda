<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SuratKeluarRequest extends FormRequest
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
            'no' => ['required'],
            'no_register' => [
                'nullable',
                'sometimes',
                Rule::unique('outboxes')->where(function ($query) {
                    $year = substr($this->date, 0, 4);
                    return $query->whereRaw('YEAR(date) = ?', [$year]);
                })->ignore($this->id)
            ],
            'title' => ['required'],
            'receiver_id' => ['required'],
            'attachment.*'  => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png'],
        ];
    }
}
