<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateUserRequest
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
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role'=>'required|string'
        ];
    }

    public function attributes()
    {
        return [
            'user.email' => 'the user\'s email'
        ];
    }
}
