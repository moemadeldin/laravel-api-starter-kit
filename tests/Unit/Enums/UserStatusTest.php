<?php

declare(strict_types=1);

use App\Enums\Userstatus;

test('tests all status enum cases', function (): void {
    expect(Userstatus::ACTIVE->value)->toBe('active');
    expect(Userstatus::INACTIVE->value)->toBe('inactive');
    expect(Userstatus::BLOCKED->value)->toBe('blocked');
    expect(Userstatus::ACTIVE->label())->toBe('Active');
    expect(Userstatus::INACTIVE->label())->toBe('Inactive');
    expect(Userstatus::BLOCKED->label())->toBe('Blocked');
});
