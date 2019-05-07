<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateCommentsRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'content' => 'required|string',
            'rating' => 'required|integer'

        ];
    }

//    public function attributes()
//    {
//        return [
//            'user.email' => 'the user\'s email'
//        ];
//    }
}
