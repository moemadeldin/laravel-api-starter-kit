<?php

declare(strict_types=1);

use App\Http\Controllers\API\V1\Auth\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function (): void {
    Route::controller(SessionController::class)->group(function (): void {
        Route::delete('/logout', 'destroy')
            ->name('logout.destroy');
    });
});
