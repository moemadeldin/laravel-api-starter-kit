<?php

declare(strict_types=1);

namespace App\Utilities;

final readonly class SuccessMessages
{
    public const string USER_REGISTERED = 'User registered successfully.';

    public const string USER_LOGGED_IN = 'User logged in successfully.';

    public const string VERIFICATION_CODE_SENT = 'Verification code sent successfully.';

    public const string VERIFICATION_CODE_VERIFIED = 'Verification code is correct.';

    public const string PASSWORD_RECOVERED = 'Password has been recovered.';
}
