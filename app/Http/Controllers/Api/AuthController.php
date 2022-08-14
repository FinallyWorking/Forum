<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Resources\ErrorResource;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\UserNotFoundException;
use App\Http\Resources\BaseResource;
use App\Http\Resources\UserResource;
use App\Repositories\Eloquent\UserRepository;

class AuthController extends Controller
{
    public function login(LoginRequest $request, UserService $userService)
    {
        try {
            [$token, $user] = $userService->authenticate($request->email, $request->password);
            return new BaseResource([
                "authorization" => [
                    "token" => $token,
                    "type" => "bearer"
                ],
                "user" => new UserResource($user)
            ]);
        } catch (UserNotFoundException $exception) {
            return new ErrorResource([
                "message" => $exception->getMessage(),
            ]);
        }
    }
}
