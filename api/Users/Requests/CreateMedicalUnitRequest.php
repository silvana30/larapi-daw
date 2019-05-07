<?php

namespace Api\Users\Requests;

use Infrastructure\Http\ApiRequest;

class CreateMedicalUnitRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'medical_unit' => 'array|required',
            'medical_unit.nume' => 'required|string',
            'medical_unit.locatie' => 'required|string',
            'medical_unit.tip_unitate' => 'required|string',
            'medical_unit.sigla' => 'required|blob'
        ];
    }

//    public function attributes()
//    {
//        return [
//            'user.email' => 'the user\'s email'
//        ];
//    }
}
