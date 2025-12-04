<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

 abstract class BaseRequest extends FormRequest {

    use ResponseTrait;

    protected function failedValidation( Validator $validator ) {

        $jsonResponse = $this->sendValidationErrors( $validator->errors() );

        throw new HttpResponseException( $jsonResponse );
    }

    protected function getBaseRules() {

        return [

            "name" => [ "required", "string", "min:3", "max:20" ]
        ];
    }
}
