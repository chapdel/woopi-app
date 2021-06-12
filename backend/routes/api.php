<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/auth/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});

// auth
Route::group(['middleware' => ['auth:sanctum'],], function () {
    Route::post('user', [ProfileController::class, 'update']);
    Route::post('user/password', [ProfileController::class, 'password']);

    Route::post('verify', [VerificationController::class, 'verify']);
    Route::post('resend', [VerificationController::class, 'resend']);

    /**
     * Channels
     */

    Route::get('spaces', [ChannelController::class, 'index']);
    Route::post('spaces', [ChannelController::class, 'store']);
    Route::post('spaces/{channel:uid}', [ChannelController::class, 'update']);
    Route::post('spaces/{channel:uid}/rooms', [ChannelController::class, 'storeRoom']);
    Route::get('spaces/{channel:uid}', [ChannelController::class, 'show']);
    Route::delete('spaces/{channel:uid}', [ChannelController::class, 'destroy']);
    Route::delete('spaces/{channel:uid}/leave', [ChannelController::class, 'leave']);
    //add member to channel
    Route::post('spaces/{channel:uid}/add-member', [ChannelController::class, 'addMember']);
    Route::post('spaces/{channel:uid}/join', [ChannelController::class, 'join']);
    Route::post('rooms/{room:uid}/message', [ChannelController::class, 'sendMessage']);
    Route::get('rooms/{room:uid}', [ChannelController::class, 'messages']);
});

// guest
Route::group(['middleware' => ['guest:sanctum'], 'prefix' => 'auth'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('password/request', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
    Route::get('password/reset/{token}', function () {
        return true;
    })->name('password.reset');
});


Route::get("countries", [CountryController::class, 'index']);
Route::get("languages", [LanguageController::class, 'index']);
