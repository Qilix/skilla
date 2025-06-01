<?php

namespace App\Http\Actions;

use App\Models\User;

class TokenActions
{
    public static function CreateToken(User $user)
    {
        return $user->createToken('Personal Access Token');
    }
}
