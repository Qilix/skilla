<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Http\DTOs\CreateUserDTO;
use App\Http\Requests\CreateAuthRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $service;
    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /*
     * Регистрация менеджера
     */
    public function register(CreateAuthRequest $request)
    {
        $dto = CreateUserDTO::fromRequest($request);
        try{
            $token = $this->service->register($dto);
        }catch(AuthException $e){
            return response(['error' => $e->getMessage()], 500);
        }

        return response(['msg' => 'Success register', 'token' => $token]);
    }
}
