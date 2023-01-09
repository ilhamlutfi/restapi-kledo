<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OvertimeRequest extends FormRequest
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
            'employee_id' => 'required|integer|exists:employees,id',
            'date' => ['required', Rule::unique('overtimes', 'date', NULL, 'id', 'employee_id')->ignore($this->overtime)],
            // 'date' => 'required|unique:overtimes,date,NULL,id,employee_id,'.$this->employee_id,
            'time_started' => 'required|date_format:H:i|before:time_ended',
            'time_ended' => 'required|date_format:H:i|after:time_started',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }
}
