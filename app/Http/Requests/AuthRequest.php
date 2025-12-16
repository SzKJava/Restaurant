<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRequest extends BaseRequest
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
// confirmed => password_confirmation
// same:password => confirm_password

        $specificRules = [ "name" => "unique:users",
                           "email" => [ "required", "email", "unique:users" ],
                           "password" => [ "required", "confirmed",
                            Password::min( 6 )
                            -> mixedCase()
                            -> numbers()
                            ->symbols()
                            //->uncompromised()
                            ]];

        foreach( $specificRules as $field => $rules ) {

            $specific = is_string( $rules ) ? explode( "|", $rules ) : $rules;
            if( array_key_exists( $field, $baseRules )) {

                $mergedRules[ $field ] = array_merge( $baseRules[ $field ], $specific ); 
            
            }else {

                $mergedRules[ $field ] = $specific;
            }
        }

        return $mergedRules;
    }
}
