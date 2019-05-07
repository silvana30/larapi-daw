<?php

namespace Infrastructure\Auth\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Auth\LoginProxy;
use Infrastructure\Auth\Requests\LoginRequest;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;
class LoginController extends Controller
{
    private $loginProxy;
    private $userService;


    public function __construct(LoginProxy $loginProxy,UserService $userService)
    {
        $this->loginProxy = $loginProxy;
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        return $this->response($this->loginProxy->attemptLogin($email, $password));
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->all();

        return $this->response($this->userService->create($data), 201);
    }
    public function refresh(Request $request)
    {
        return $this->response($this->loginProxy->attemptRefresh());
    }

    public function logout()
    {
        $this->loginProxy->logout();


        return $this->response(null, 204);
    }
}