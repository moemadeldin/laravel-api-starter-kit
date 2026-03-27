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

    public function handle(array $data): User
    {
        $user = User::query()->create($data);
        $this->tokenManager->createAccessToken($user, Constants::REGISTER_TOKEN_TYPE);

        return $user;
    }
}
