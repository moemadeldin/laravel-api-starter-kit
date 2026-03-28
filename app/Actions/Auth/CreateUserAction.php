<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\TokenManager;
use App\Utilities\Constants;

final readonly class CreateUserAction
{
    public function __construct(
        private TokenManager $tokenManager,
    ) {}

    public function handle(string $name, string $email, string $password): User
    {
        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        $this->tokenManager->createAccessToken($user, Constants::REGISTER_TOKEN_TYPE);

        return $user;
    }
}
