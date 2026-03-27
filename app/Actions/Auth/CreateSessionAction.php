<?php

declare(strict_types=1);

namespace App\Actions\Auth;

use App\Models\User;
use App\Services\TokenManager;
use App\Services\UserValidator;
use App\Utilities\Constants;

final readonly class CreateSessionAction
{
    public function __construct(
        private TokenManager $tokenManager,
        private UserValidator $userValidator
    ) {}

    public function handle(array $data): User
    {
        $user = User::getUserByEmail($data['email'])->first();
        $this->userValidator->validateUserCredentials($user, $data['password']);
        $this->userValidator->validateUserIsActive($user);

        $this->tokenManager->createAccessToken($user, Constants::LOGIN_TOKEN_TYPE);

        return $user;
    }
}
