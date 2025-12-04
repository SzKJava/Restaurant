<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends BaseRequest
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

        $baseRules = $this->getBaseRules();

        $specificRules = [
            
            "date" => [ "required", "date", "after_or_equal:today" ],
            "quantity" => [ "required", "numeric" ]
        ];

        return array_merge( $baseRules, $specificRules );
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
}
