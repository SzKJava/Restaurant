<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends BaseRequest {
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

        $baseRules = $this->getBaseRules();

        $specificRules = [
            
            "name" => "unique:menuitems",
            "category" => [ "required", "string", "max:20" ],
            "price" => [ "required", "numeric" ]
        ];

        return array_merge( $baseRules, $specificRules );
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
}