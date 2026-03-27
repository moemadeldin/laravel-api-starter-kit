<?php

declare(strict_types=1);

use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;

it('can login user', function (): void {
    $user = User::factory()->create([
        'email' => 'johndoe@gmail.com',
        'password' => 'password123456',
    ]);

    $response = $this->postJson(route('login.store'), [
        'email' => 'johndoe@gmail.com',
        'password' => 'password123456',
    ]);
    $response->assertOk();
    $response->assertJsonStructure([
        'data' => [
            'user' => [
                'id',
                'name',
                'email',
            ],
            'access_token',
        ],
    ]);
    $response->assertJson([
        'data' => [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ],
        ],
    ]);
    expect($response->json('data.access_token'))->toBeString();
});

it('validates login fields', function (): void {
    $response = $this->postJson(route('login.store'), []);

    $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    $response->assertJsonValidationErrors(['email', 'password']);
});
it('returns error when login fails', function (): void {
    User::factory()->create([
        'email' => 'johndoe@gmail.com',
        'password' => 'correctpassword123',
        'status' => UserStatus::BLOCKED->value,
    ]);

    $response = $this->postJson(route('login.store'), [
        'email' => 'johndoe@gmail.com',
        'password' => 'wrongpassword123',
    ]);

    $response->assertStatus(Response::HTTP_BAD_REQUEST);

});
// it('returns unauthenticated when not logged in', function (): void {
//     $response = $this->getJson(route('me.show'));

//     $response->assertStatus(Response::HTTP_UNAUTHORIZED);
//     $response->assertJson([
//         'message' => 'Unauthenticated.',
//     ]);
// });
// it('returns user details', function (): void {
//     $user = User::factory()->create();

//     Sanctum::actingAs($user, ['*']);

//     $response = $this->getJson(route('me.show'));

//     $response->assertOk();
//     $response->assertJsonStructure([
//         'data' => [
//             'authenticated',
//             'user' => [
//                 'id',
//                 'name',
//                 'email',
//                 'status',
//             ],
//         ],
//     ]);
//     $response->assertJson([
//         'data' => [
//             'authenticated' => true,
//             'user' => [
//                 'id' => $user->id,
//                 'name' => $user->name ?? null,
//                 'email' => $user->email,
//                 'status' => $user->status->label(),
//             ],
//         ],
//     ]);
// });
it('can log out', function (): void {
    $user = User::factory()->create();

    Sanctum::actingAs($user, ['*']);

    $response = $this->deleteJson(route('logout.destroy'));
    $response->assertNoContent();

    expect($user->tokens()->count())->toBe(0);
});
it('require authentication to log out', function (): void {

    $response = $this->deleteJson(route('logout.destroy'));

    $response->assertStatus(Response::HTTP_UNAUTHORIZED);

});
