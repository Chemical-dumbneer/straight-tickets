<?php

use App\Http\Controllers\API\V1\TicketController as TicketV1Controller;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/tickets', [TicketV1Controller::class, 'index']);
        Route::post('/tickets', [TicketV1Controller::class, 'store']);
        Route::get('/tickets/{ticket}', [TicketV1Controller::class, 'show']);
        Route::put('/tickets/{id}', [TicketV1Controller::class, 'update']);
    });
});
