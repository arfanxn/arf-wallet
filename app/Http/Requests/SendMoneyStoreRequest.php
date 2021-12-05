<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendMoneyStoreRequest extends FormRequest
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
            "amount" => ["required", "numeric", "min:10000"], "description" => ["nullable", "string"],
        ];
    }

    public function messages()
    {
        return [
            "amount.required" => "Masukan nominal kirim uang.",
            "amount.min" => "Miinimal transfer adalah 10.000",
        ];
    }
}
