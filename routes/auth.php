<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::controller(AuthController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    // Route::get('/register', 'register'])->name('register');
    // Route::post('/register-store', 'registerStore'])->name('registerStore');
    Route::get('/register-verify/{token}', 'registerVerify')->name('registerVerify');
    Route::get('/verify-notification', 'verifyNotification')->name('verifyNotification');

    Route::post('/verify-resend', 'verifyResend')->name('verifyResend');

    Route::get('/forget-password', 'forgetPassword')->name('forgetPassword');
    Route::post('/forget-password-process', 'forgetPasswordProcess')->name('forgetPasswordProcess');
    Route::get('/reset-password/{token}', 'resetPassword')->name('resetPassword');
    Route::post('/reset-password-process', 'resetPasswordProcess')->name('resetPasswordProcess');
    Route::get('/reset-verify-notification', 'resetVerifyNotification')->name('resetVerifyNotification');

    Route::post('/login-process', 'loginProcess')->name('loginProcess');
    Route::get('/logout', 'logout')->name('logout');
});
