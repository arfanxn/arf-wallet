<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class SendMoneyRequest extends FormRequest
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
        return [];
    }

    public function validatorRules()
    {
        return [
            "amount" => ["required", "numeric", "min:10000"],
            "description" => ["nullable", "string", "max:250"],
        ];
    }

    public function validatorMake()
    {
        return Validator::make($this->all(), $this->validatorRules(), $this->messages());
    }

    public function messages()
    {
        return [
            "amount.required" => "Masukan nominal kirim uang.",
            "amount.min" => "Minimal transfer adalah IDR 10.000",
        ];
    }
}
