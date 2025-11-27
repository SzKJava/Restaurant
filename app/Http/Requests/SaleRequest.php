<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => [ "required", "string" ],
            "date" => [ "required", "date", "after_or_equal:today" ],
            "quantity" => [ "required", "numeric" ]
        ];
    }

    public function messages() {

        return [
            "name.required" => "Étel mező nem lehet üres.",
            "name.string" => "Étel neve csak szöveg lehet.",
            "date.required" => "Dátum mező nem lehet üres.",
            "date.date" => "Nem megfelelő dátum formátum.",
            "date.after_or_equal" => "Dátum nem megfelelő",
            "quantity.required" => "Mennyiség mező nem lehet üres.",
            "quantity.numeric" => "Mennyiség csak szám lehet."
        ];
    }

    public function failedValidation( Validator $validator ) {

        throw new HttpResponseException( response()->json([

            "success" => false,
            "message" => "Validációs hiba",
            "error" =>$validator->errors()
        ]));
    }
}
