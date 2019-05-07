<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateDoctorRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'nume' => 'required|string',
            'an_absolvire' => 'required|integer',
            'specializare' => 'required|string',
            'poza_profil' => 'required'
        ];
    }

//    public function attributes()
//    {
//        return [
//            'user.email' => 'the user\'s email'
//        ];
//    }
}
