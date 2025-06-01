<?php

namespace App\Http\DTOs\User;

use App\Http\Requests\AuthRequests\LoginAuthRequest;

class LoginUserDTO
{
    public string $email;
    public string $password;

    public static function fromRequest(LoginAuthRequest $request): self
    {
        $dto = new self();
        $dto->email = $request->input('email');
        $dto->password = $request->input('password');

        return $dto;
    }
}
