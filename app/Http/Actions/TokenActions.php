<?php

namespace App\Http\Actions;

use App\Models\User;
use Illuminate\Support\Str;

class TokenActions
{
    public static function CreateToken(User $user)
    {
        return $user->createToken(Str::random(128));
    }
    public static function RevokeToken(User $user)
    {
        return $user->token()->revoke();
    }
}
