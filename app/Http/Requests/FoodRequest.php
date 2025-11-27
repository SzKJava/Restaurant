<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class FoodRequest extends FormRequest
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
    public function rules(): array {

        return [
            
            "name" => [ "required", "string", "max:50", "unique:menuitems" ],
            "category" => [ "required", "string", "max:20" ],
            "price" => [ "required", "numeric" ]
        ];
    }

    public function messages() {

        return [
            "name.required" => "Név mező nem lehet üres.",
            "name.string" => "Név mező csak szöveg lehet.",
            "name.max" => "Név mező túl hosszú.",
            "name.unique" => "A név már létezik.",
            "category.required" => "Kategoria mező nem lehet üres.",
            "category.string" => "Kategoria mező csak szöveg lehet.",
            "category.max" => "Kategoria mező túl hosszú.",
            "price.required" => "Ár mező nem lehet üres.",
            "price.numeric" => "Ár mező csak szám lehet."
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
