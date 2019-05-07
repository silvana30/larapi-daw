<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateMedDocRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'id' => 'required',

        ];
    }

//    public function attributes()
//    {
//        return [
//            'user.email' => 'the user\'s email'
//        ];
//    }
}
