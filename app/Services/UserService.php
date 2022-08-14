<?php

namespace App\Services;

use App\Enums\ErrorCode;
use App\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function authenticate(string $email, string $password): array
    {
        $ttl = now()->addYear()->diffInMinutes(now());
        $token = Auth::setTTL($ttl)->attempt(['email' => $email, 'password' => $password]);

        if (! $token) {
            throw new UserNotFoundException('Credentials not match.', ErrorCode::credential_not_match);
        }

        return [$token, Auth::user()];
    }
}
