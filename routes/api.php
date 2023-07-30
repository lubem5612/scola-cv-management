<?php

use Illuminate\Support\Facades\Route;
use Transave\ScolaCvManagement\Http\Controllers\Auth\AuthenticationController;
use Transave\ScolaCvManagement\Http\Controllers\CredentialController;
use Transave\ScolaCvManagement\Http\Controllers\PublicationController;
use Transave\ScolaCvManagement\Http\Controllers\ResourceController;
use Transave\ScolaCvManagement\Http\Controllers\UserController;
use Transave\ScolaCvManagement\Http\Controllers\GalleryController;

Route::as('cv.')->group(function () {
    Route::post('register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::get('user', [ AuthenticationController::class, 'user'])->name('user');
    Route::post('resend-token', [ AuthenticationController::class, 'resendToken'])->name('resend-token');
    Route::post('verify-email', [ AuthenticationController::class, 'verifyEmail'])->name('verify-email');
    Route::any('logout', [ AuthenticationController::class, 'logout'])->name('logout');
});

Route::as('cv.')->prefix('credentials')->group(function() {
    Route::get('/', [ CredentialController::class, 'index'])->name('index');
    Route::post('/', [ CredentialController::class, 'store'])->name('store');
    Route::get('/{id}', [ CredentialController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ CredentialController::class, 'update'])->name('update');
    Route::delete('/{id}', [ CredentialController::class, 'destroy'])->name('delete');
});

Route::as('cv.publications.')->prefix('publications')->group(function() {
    Route::get('/', [ PublicationController::class, 'index'])->name('index');
    Route::post('/', [ PublicationController::class, 'store'])->name('store');
    Route::get('/{id}', [ PublicationController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ PublicationController::class, 'update'])->name('update');
    Route::delete('/{id}', [ PublicationController::class, 'destroy'])->name('delete');
});

Route::as('cv.galleries.')->prefix('galleries')->group(function() {
    Route::get('/', [ GalleryController::class, 'index'])->name('index');
    Route::post('/', [ GalleryController::class, 'store'])->name('store');
    Route::get('/{id}', [ GalleryController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ GalleryController::class, 'update'])->name('update');
    Route::delete('/{id}', [ GalleryController::class, 'destroy'])->name('delete');
});

Route::as('cv.users.')->prefix('users')->group(function() {
    Route::get('/', [ UserController::class, 'index'])->name('index');
    Route::get('/{id}', [ UserController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [ UserController::class, 'destroy'])->name('delete');
});

Route::as('cv.')->group(function () {
    Route::get('{endpoint}', [ResourceController::class, 'index'])->name('index');
    Route::post('{endpoint}', [ResourceController::class, 'store'])->name('store');
    Route::get('{endpoint}/{id}', [ResourceController::class, 'show'])->name('show');
    Route::match(['POST', 'PATCH', 'PUT'],'{endpoint}/{id}', [ResourceController::class, 'update'])->name('update');
    Route::delete('{endpoint}/{id}', [ResourceController::class, 'destroy'])->name('delete');
});
