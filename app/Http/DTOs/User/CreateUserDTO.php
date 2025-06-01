<?php

namespace App\Http\DTOs\User;

use App\Http\Requests\AuthRequests\CreateAuthRequest;

class CreateUserDTO
{
    public string $name;
    public string $email;
    public string $password;

    public static function fromRequest(CreateAuthRequest $request): self
    {
        $dto = new self();
        $dto->name = $request->input('name');
        $dto->email = $request->input('email');
        $dto->password = $request->input('password');

        return $dto;
    }
}
