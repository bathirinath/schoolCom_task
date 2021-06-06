<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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

Route::post('/login', [StudentController::class, 'login']);
Route::post('/register', [StudentController::class, 'register']);

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/logout', [StudentController::class, 'logout']);
    Route::post('/balanced', [StudentController::class, 'balanced']);
    Route::get('/user-profile', [StudentController::class, 'userProfile']);    
});

