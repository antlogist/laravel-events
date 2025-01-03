<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ParticipantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::apiResource('events', EventController::class)->middleware('auth:sanctum')->except('index');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/events/{event}/participants', [ParticipantController::class, 'index'])->name('events.participants.index');
Route::get('/events/{event}/participants/{participant}', [ParticipantController::class, 'index'])->name('events.participants.show');
Route::apiResource('events.participants', ParticipantController::class)->except(['update'])->middleware('auth:sanctum')->except('index', 'show');
