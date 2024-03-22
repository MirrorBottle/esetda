<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMouRequest extends FormRequest
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
            'category_id' => 'required',
            'country_id' => 'required',
            'cooperation_field' => 'required',
            'cooperation_type_id' => 'required',
            'year' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'attachment' => 'file|mimes:pdf'
        ];
    }
}
