<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;
use Illuminate\Validation\Validator;
use Api\Users\Models\Register;
use Api\Users\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        return $this->response($parsedData);
    }

    public function getById($userId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getById($userId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->all();

        return $this->response($this->userService->create($data), 201);
    }

    public function register(Register $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'role'=>'required|string'
        ];

        $input     = $request->only( 'email','password','role');
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT)]);
        return $user;
    }

    public function update($userId, Request $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->update($userId, $data));
    }

    public function delete($userId)
    {
        return $this->response($this->userService->delete($userId));
    }

    public function getLoggedUser(){
        return Auth::user();

    }

}
