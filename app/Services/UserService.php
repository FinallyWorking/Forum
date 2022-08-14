<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UserNotFoundException;

class UserService
{
    public function authenticate(string $email, string $password): array
    {
        $ttl = now()->addYear()->diffInMinutes(now());
        $token = Auth::setTTL($ttl)->attempt(["email" => $email, "password" => $password]);

        if (!$token) {
            throw new UserNotFoundException("Credentials not match.");
        }

        return [$token, Auth::user()];
    }
}
