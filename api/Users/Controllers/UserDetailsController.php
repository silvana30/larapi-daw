<?php

namespace Api\Users\Controllers;

use Api\Users\Requests\CreateUploadPhotoRequest;
use Api\Users\Requests\CreateUserDetailsRequest;
use Api\Users\Services\UserDetailsService;
use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDoctorRequest;
use Api\Users\Services\DoctorService;
use Api\Users\Requests\CreateMedDocRequest;


class UserDetailsController extends Controller
{
    private $userService;

    public function __construct(UserDetailsService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'userDetails');

        return $this->response($parsedData);
    }

//    public function getById($userId)
//    {
//        $resourceOptions = $this->parseResourceOptions();
//
//        $data = $this->userService->getById($userId, $resourceOptions);
//        $parsedData = $this->parseData($data, $resourceOptions, 'userDetails');
//
//        return $this->response($parsedData);
//    }
    public function getById( CreateMedDocRequest $req){
        $resourceOptions = $this->parseResourceOptions();
        $data = $this->userService->getById($req['id'],$resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'userDetails');
        return $this->response($parsedData);

    }
    public function create(CreateUserDetailsRequest $request)
    {
        $data = $request->all();

        return $this->response($this->userService->create($data), 201);
    }

    public function update( CreateUserDetailsRequest $request)
    {
        $data = $request->all();

        return $this->response($this->userService->update( $data));
    }

    public function uploadPic( CreateUploadPhotoRequest $request)
    {
        $data = $request['imag_profil'];

        return $this->response($this->userService->upload( $data));
    }

    public function delete($userId)
    {
        return $this->response($this->userService->delete($userId));
    }
}
