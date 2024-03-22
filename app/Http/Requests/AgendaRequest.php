<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'event' => 'required',
            'user_id' => 'required',
            'place_id' => 'required',
            'apparel_id' => 'required',
            'disposition_id' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];
    }
}
