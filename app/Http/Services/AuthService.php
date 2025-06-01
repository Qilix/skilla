<?php

namespace App\Http\Services;

use App\Http\Actions\TokenActions;
use App\Http\DTOs\User\CreateUserDTO;
use App\Http\DTOs\User\LoginUserDTO;
use App\Http\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /*
     * Регистрация менеджера с выдачей персонального токена
     */
    public function register(CreateUserDTO $dto): array
    {
        $user = $this->userRepository->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
        ]);

        $tokenData = TokenActions::CreateToken($user);

        return [
            'access_token' => $tokenData->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenData->token->expires_at->toDateTimeString(),
            'user' => $user
        ];
    }

    /*
     * Авторизация менеджера с выдачей токена
     */
    public function login(LoginUserDTO $dto): array
    {
        if (!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные'],
            ]);
        }

        $user = Auth::user();
        $tokenData = TokenActions::CreateToken($user);

        return [
            'access_token' => $tokenData->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $tokenData->token->expires_at->toDateTimeString(),
            'user' => $user
        ];
    }

    public function logout(User $user): void
    {
        TokenActions::RevokeToken($user);
    }

    public function activeSessions(User $user): object
    {
        return $this->userRepository->getActiveSessions($user);
    }
}
