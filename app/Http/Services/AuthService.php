<?php

namespace App\Http\Services;

use App\Http\DTOs\CreateUserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /*
     * Регистрация менеджера с выдачей персонального токена
     */
    public function register(CreateUserDTO $dto)
    {
        $user = User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->accessToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_at' => $tokenResult->token->expires_at->toDateTimeString(),
            'user' => $user
        ];
    }
}
