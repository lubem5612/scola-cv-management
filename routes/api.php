<?php

use Illuminate\Support\Facades\Route;
use Transave\ScolaCvManagement\Http\Controllers\Auth\AuthenticationController;

Route::as('cv.')->group(function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
});