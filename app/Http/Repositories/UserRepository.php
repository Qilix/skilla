<?php

namespace App\Http\Repositories;

use App\Models\User;
use Carbon\Carbon;

class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function getActiveSessions($user): object
    {
        return $user->tokens()
            ->where('revoked', false)
            ->where('expires_at', '>', Carbon::now())
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
