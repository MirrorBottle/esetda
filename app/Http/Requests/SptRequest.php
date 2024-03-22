<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SptRequest extends FormRequest
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
            // 'letter_number' => 'required|unique:spts,letter_number,' . $this->spt,
            'skpd_employee_id' => 'required',
            'skpd_employee_name' => 'required',
            'purpose' => 'required',
            'place' => 'required',
            'destination' => 'required',
            'duration' => 'required',
            'departure_date' => 'required',
            'return_date' => 'required',
            'budget_expanse' => 'required',
            'signer_id' => 'required',
        ];
    }
}
