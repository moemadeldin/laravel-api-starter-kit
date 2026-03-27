<?php

declare(strict_types=1);

namespace App\Utilities;

final readonly class ErrorMessages
{
    public const string AUTHENTICATION_FAILED = 'Authentication failed.';

    public const string USER_NOT_ACTIVE = 'User is not active.';

    public const string INVALID_CREDENTIALS = 'Invalid credentials.';

    public const string INVALID_VERIFICATION_CODE = 'Invalid verification code.';
}
