<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Auth;

use App\Actions\Auth\CreateUserAction;
use App\Http\Requests\Auth\StoreUserRequest;
use App\Utilities\APIResponses;
use App\Utilities\SuccessMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final readonly class RegisterController
{
    use APIResponses;

    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreUserRequest $request, CreateUserAction $action): JsonResponse
    {
        $validated = $request->validated();

        /** @var string $name */
        $name = $validated['name'];

        /** @var string $email */
        $email = $validated['email'];

        /** @var string $password */
        $password = $validated['password'];

        return $this->success(
            $action->handle($name,
                $email,
                $password),
            SuccessMessages::USER_REGISTERED, Response::HTTP_CREATED
        );
    }
}
