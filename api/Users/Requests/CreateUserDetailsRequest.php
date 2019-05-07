<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateUserDetailsRequest
    extends ApiRequest
{


    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
//            'user' => 'array|required',
            'id' => '',
            'nume' => 'string',
            'afectiune' => 'string',
            'imag_profil' => ''
        ];
    }

    public function attributes()
    {
        return [
            'user.email' => 'the user\'s email'
        ];
    }
}
