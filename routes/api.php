<?php

use Illuminate\Support\Facades\Route;
use Transave\ScolaCvManagement\Http\Controllers\AchievementController;
use Transave\ScolaCvManagement\Http\Controllers\Auth\AuthenticationController;
use Transave\ScolaCvManagement\Http\Controllers\CredentialController;
use Transave\ScolaCvManagement\Http\Controllers\PublicationController;

Route::as('cv.')->group(function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('user', [ AuthenticationController::class, 'user'])->name('user');
    Route::post('resend-token', [ AuthenticationController::class, 'resendToken'])->name('resend-token');
    Route::post('verify-email', [ AuthenticationController::class, 'verifyEmail'])->name('verify-email');
    Route::any('logout', [ AuthenticationController::class, 'logout'])->name('logout');
});



Route::as('cv.')->prefix('publications')->group(function() {
    Route::post('store', [PublicationController::class, 'store'])->name('store');
    Route::get('/{id}', [ PublicationController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ PublicationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ PublicationController::class, 'delete'])->name('delete');
});


Route::as('cv.')->prefix('achievements')->group(function() {
    Route::post('store', [AchievementController::class, 'store'])->name('store');
    Route::get('/{id}', [ AchievementController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ AchievementController::class, 'update'])->name('update');
    Route::delete('/{id}', [ AchievementController::class, 'delete'])->name('delete');
});


Route::as('cv.')->prefix('credentials')->group(function() {
    Route::get('/', [ CredentialController::class, 'index'])->name('index');
    Route::post('/', [ CredentialController::class, 'store'])->name('store');
    Route::get('/{id}', [ CredentialController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ CredentialController::class, 'update'])->name('update');
    Route::delete('/{id}', [ CredentialController::class, 'destroy'])->name('delete');
});
