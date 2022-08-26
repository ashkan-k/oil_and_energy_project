<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

## Login ##
Route::get('login' , [AuthController::class , 'login'])->name('login');
Route::post('login' , [AuthController::class , 'login'])->name('login');
## Logout ##
Route::post('logout' , [AuthController::class , 'logout'])->name('logout');

## Register ##
Route::get('register' , [AuthController::class , 'register'])->name('register');
Route::post('register' , [AuthController::class , 'register'])->name('register');

## Profile ##
Route::get('profile' , [AuthController::class , 'profile'])->name('profile');
Route::post('profile' , [AuthController::class , 'profile'])->name('profile');

## Code ##
Route::post('code/send' , [AuthController::class , 'send_code_ajax'])->name('send_code');
Route::get('verify' , [AuthController::class , 'verify'])->name('verify');
Route::post('verify' , [AuthController::class , 'verify'])->name('verify');

## Reset Password ##
Route::get('reset_password' , [AuthController::class , 'reset_password_mobile'])->name('reset_password.mobile');
Route::post('reset_password' , [AuthController::class , 'reset_password_mobile'])->name('reset_password.mobile');

Route::get('reset_password/confirm' , [AuthController::class , 'reset_password_confirm'])->name('reset_password.confirm');
Route::post('reset_password/confirm' , [AuthController::class , 'reset_password_confirm'])->name('reset_password.confirm');

Route::get('reset_password/enter' , [AuthController::class , 'reset_password_enter'])->name('reset_password.enter');
Route::post('reset_password/enter' , [AuthController::class , 'reset_password_enter'])->name('reset_password.enter');
