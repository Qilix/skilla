<?php

namespace App\Http\Controllers;

use App\Exceptions\AuthException;
use App\Http\DTOs\User\CreateUserDTO;
use App\Http\DTOs\User\LoginUserDTO;
use App\Http\Requests\AuthRequests\CreateAuthRequest;
use App\Http\Requests\AuthRequests\LoginAuthRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;

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

    /*
     * Авторизация менеджера
     */
    public function login(LoginAuthRequest $request)
    {
        $dto = LoginUserDTO::fromRequest($request);
        try{
            $token = $this->service->login($dto);
        }catch(AuthException $e){
            return response(['error' => $e->getMessage()], 500);
        }

        return response(['msg' => 'Success login', 'token' => $token]);
    }

    /*
     * Выход из системы
     */
    public function logout(Request $request)
    {
        try{
            $this->service->logout($request->user());
        }catch(AuthException $e){
            return response(['error' => $e->getMessage()], 500);
        }

        return response(['msg' => 'Success logout']);
    }

    /*
     * Просмотр всех активных сессий пользователя
     */
    public function sessions(Request $request)
    {
        return $this->service->activeSessions($request->user());
    }
}
