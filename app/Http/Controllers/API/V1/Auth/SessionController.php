<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Auth;

use App\Actions\Auth\CreateSessionAction;
use App\Exceptions\AuthException;
use App\Http\Requests\Auth\StoreSessionRequest;
use App\Http\Resources\SessionResource;
use App\Models\User;
use App\Services\TokenManager;
use App\Utilities\APIResponses;
use App\Utilities\SuccessMessages;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final readonly class SessionController
{
    use APIResponses;

    public function __construct(private TokenManager $tokenManager) {}

    public function store(StoreSessionRequest $request, CreateSessionAction $action): JsonResponse
    {
        try {
            $validated = $request->validated();

            /** @var string $email */
            $email = $validated['email'];

            /** @var string $password */
            $password = $validated['password'];

            return $this->success(
                new SessionResource(
                    $action->handle($email, $password),
                ),
                SuccessMessages::USER_LOGGED_IN
            );
        } catch (AuthException $authException) {
            return $this->fail($authException->getMessage(), $authException->getCode());
        }
    }

    public function destroy(#[CurrentUser] User $user): Response
    {
        $this->tokenManager->deleteAccessToken($user);

        return $this->noContent();
    }
}
