<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateUploadPhotoRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'imag_profil' => 'required'
        ];
    }

//    public function attributes()
//    {
//        return [
//            'user.email' => 'the user\'s email'
//        ];
//    }
}
