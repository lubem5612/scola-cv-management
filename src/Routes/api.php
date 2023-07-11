<?php
use Illuminate\Support\Facades\Route;

use Transave\ScolaCvManagement\Http\Controllers\Auth\RegisterNewAccountController;
use Transave\ScolaCvManagement\Http\Controllers\Auth\LoginAccountController;
use Transave\ScolaCvManagement\Http\Controllers\Auth\LogoutAcountController;


//    AUTH ROUTES
Route::group(['namespace' => 'Transave\ScolaCvManagement\Http\Controllers\Auth', 'middleware' => ['api']], function(){
    Route::POST('register', 'RegisterNewAccountController@register')->name('register');
    Route::POST('login', 'LoginAccountController@login')->name('login');
    Route::POST('logout', 'LogoutAcountController@logout')->name('logout');
});


//User ROUTES
Route::group(['namespace' => 'Transave\ScolaCvManagement\Http\Controllers\User', 'middleware' => ['api']], function(){
    //   Controllers\User\AchievementController
    Route::post('registerAch', 'UserAchievementController@register')->name('registerAch');
    Route::patch('updateAch', 'UserAchievementController@updateAch')->name('updateAch');
    Route::delete('deleteAch', 'UserAchievementController@deleteAch')->name('deleteAch');
    Route::get('viewAllAch', 'UserAchievementController@viewAllAch')->name('viewAllAch');

    //   Controllers\User\UserProfileController
    Route::patch('edit', 'UserProfileController@edit')->name('edit');
    Route::get('view', 'UserProfileController@view')->name('view');

    //   Controllers\User\UserPublicationController
    Route::post('createPub', 'UserPublicationController@createPub')->name('createPub');
    Route::patch('updatePub', 'UserProfileController@updatePub')->name('updatePub');
    Route::get('viewAllPub', 'UserPublicationController@viewAllPub')->name('viewAllPub');
    Route::get('viewPubDetails', 'UserProfileController@viewPubDetails')->name('viewPubDetails');

    //   Controllers\User\UserWorkExperienceController
    Route::post('createWorkExp', 'UserPublicationController@createWorkExp')->name('createWorkExp');
    Route::delete('deleteWorkExp', 'UserProfileController@updatePub')->name('updatePub');
    Route::patch('updateWorkExp', 'UserPublicationController@updateWorkExp')->name('updateWorkExp');
    Route::get('viewWorkExp', 'UserProfileController@viewWorkExp')->name('viewWorkExp');

});



//    ADMIN ROUTES
Route::group(['namespace' => 'Transave\ScolaCvManagement\Http\Controllers\Admin', 'middleware' => ['api']], function(){

//    Admin\AchievementController
    Route::post('registerUserAch', 'AchievementController@registerUserAch')->name('registerUserAch');
    Route::delete('deleteUserAch', 'AchievementController@deleteUserAch')->name('deleteUserAch');
    Route::get('viewUserAch', 'AchievementController@viewUserAch')->name('viewUserAch');
    Route::patch('updateUserAch', 'AchievementController@updateUserAch')->name('updateUserAch');
    Route::get('viewSingleAch', 'AchievementController@viewSingleAch')->name('viewSingleAch');


    //    Admin\AdminAuthController
    Route::post('registerUser', 'AdminAuthController@registerUser')->name('registerUser');
    Route::post('registerAdmin', 'AchievementController@registerAdmin')->name('registerAdmin');

    //    Admin\DepartmentController
    Route::post('registerDept', 'DepartmentController@registerDept')->name('registerDept');
    Route::delete('deleteDept', 'DepartmentController@deleteUserAch')->name('deleteUserAch');
    Route::patch('updateDept', 'DepartmentController@updateDept')->name('updateDept');
    Route::get('viewDept', 'DepartmentController@viewDept')->name('viewDept');


});

