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

    public function handle(string $email, string $password): User
    {
        $user = User::query()->whereEmail($email)->first();

        $this->userValidator->validateUserCredentials($user, $password);
        $this->userValidator->validateUserIsActive($user);

        assert($user instanceof User);

        $this->tokenManager->createAccessToken($user, Constants::LOGIN_TOKEN_TYPE);

        return $user;
    }
}
