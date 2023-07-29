<?php

use Illuminate\Support\Facades\Route;
use Transave\ScolaCvManagement\Http\Controllers\AchievementController;
use Transave\ScolaCvManagement\Http\Controllers\Auth\AuthenticationController;
use Transave\ScolaCvManagement\Http\Controllers\CredentialController;
use Transave\ScolaCvManagement\Http\Controllers\PublicationController;
use Transave\ScolaCvManagement\Http\Controllers\RefereeController;
use Transave\ScolaCvManagement\Http\Controllers\SchoolController;
use Transave\ScolaCvManagement\Http\Controllers\SpecializationController;
use Transave\ScolaCvManagement\Http\Controllers\WorkExperienceController;

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


Route::as('cv.')->prefix('work_experiences')->group(function() {
    Route::get('/', [ WorkExperienceController::class, 'index'])->name('index');
    Route::post('store', [ WorkExperienceController::class, 'store'])->name('store');
    Route::get('show/{cv_id}', [ WorkExperienceController::class, 'show'])->name('show');
    Route::PATCH('update/{id}', [ WorkExperienceController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ WorkExperienceController::class, 'delete'])->name('delete');
});

Route::as('cv.')->prefix('specializations')->group(function() {
    Route::get('/', [ SpecializationController::class, 'index'])->name('index');
    Route::post('store', [ SpecializationController::class, 'store'])->name('store');
    Route::get('show/{cv_id}', [ SpecializationController::class, 'show'])->name('show');
    Route::PATCH('update/{id}', [ SpecializationController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ SpecializationController::class, 'delete'])->name('delete');
});


Route::as('cv.')->prefix('schools')->group(function() {
    Route::get('/', [ SchoolController::class, 'index'])->name('index');
    Route::post('store', [ SchoolController::class, 'store'])->name('store');
    Route::get('show', [ SchoolController::class, 'show'])->name('show');
    Route::PATCH('update/{id}', [ SchoolController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ SchoolController::class, 'delete'])->name('delete');
});



Route::as('cv.')->prefix('referees')->group(function() {
    Route::get('/', [ RefereeController::class, 'index'])->name('index');
    Route::post('store', [ RefereeController::class, 'store'])->name('store');
    Route::get('show/{cv_id}', [ RefereeController::class, 'show'])->name('show');
    Route::PATCH('update/{id}', [ RefereeController::class, 'update'])->name('update');
    Route::delete('delete/{id}', [ RefereeController::class, 'delete'])->name('delete');
});



Route::as('cv.')->prefix('credentials')->group(function() {
    Route::get('/', [ CredentialController::class, 'index'])->name('index');
    Route::post('/', [ CredentialController::class, 'store'])->name('store');
    Route::get('/{id}', [ CredentialController::class, 'show'])->name('show');
    Route::match(['POST', 'PUT', 'PATCH'],'/{id}', [ CredentialController::class, 'update'])->name('update');
    Route::delete('/{id}', [ CredentialController::class, 'destroy'])->name('delete');
});
