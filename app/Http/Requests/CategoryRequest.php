<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends BaseRequest {
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

        return $this->getBaseRules();
    }

    public function messages() {

        return [
            "name.required" => "Kategoria mező nem lehet üres.",
            "name.string" => "Kategoria mező csak szöveg lehet.",
            "name.max" => "Kategoria mező túl hosszú."
        ];
    }
}
