<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\AuthException;
use App\Models\User;
use App\Utilities\ErrorMessages;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use SensitiveParameter;

final readonly class UserValidator
{
    public function validateUser(?User $user): void
    {
        throw_unless($user instanceof User, AuthException::class, ErrorMessages::INVALID_CREDENTIALS, Response::HTTP_BAD_REQUEST);
    }

    public function validateUserIsActive(?User $user): void
    {
        throw_unless($user->isActive(), AuthException::class, ErrorMessages::AUTHENTICATION_FAILED, Response::HTTP_FORBIDDEN);
    }

    public function validateUserCredentials(User $user, #[SensitiveParameter] string $password): void
    {
        throw_unless(Hash::check($password, $user->password), AuthException::class, ErrorMessages::INVALID_CREDENTIALS, Response::HTTP_BAD_REQUEST);
    }

    public function validateVerificationCode(User $user, string $verificationCode): void
    {
        throw_if($user->verification_code !== $verificationCode, AuthException::class, ErrorMessages::INVALID_VERIFICATION_CODE, Response::HTTP_BAD_REQUEST);
    }
}
