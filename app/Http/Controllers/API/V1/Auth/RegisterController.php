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
        return $this->success(
            $action->handle($request->validated()),
            SuccessMessages::USER_REGISTERED, Response::HTTP_CREATED
        );
    }
}
