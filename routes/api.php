<?php

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/v1/register-user', 'UserController@register');
Route::post('/v1/register-user', [UserController::class, 'register']);
Route::post('/v1/login-user', [UserController::class, 'login']);

//INTERNSHIP
Route::get('/v1/internship', [InternshipController::class, 'index']);

Route::get('/v1/internship/search/{name}', [InternshipController::class, 'search']);
//filter
Route::get('/v1/internship/filter/{attribute}/{value}', [InternshipController::class, 'FilterOneCombination']);
Route::get('/v1/internship/filter/{attribute}/{value}/{attribute2}/{value2}', [InternshipController::class, 'FilterTwoCombination']);
Route::get('/v1/internship/filter/{attribute}/{value}/{attribute2}/{value2}/{attribute3}/{value3}', [InternshipController::class, 'FilterThreeCombination']);
Route::get('/v1/internship/filter/{attribute}/{value}/{attribute2}/{value2}/{attribute3}/{value3}/{attribute4}/{value4}', [InternshipController::class, 'FilterFourCombination']);
//TAG
Route::get('/v1/tag', [TagController::class, 'index']);
Route::get('/v1/tag/search/{name}', [TagController::class, 'search']);

//LOCATION
Route::get('/v1/location', [LocationController::class, 'index']);
Route::get('/v1/location/search/{name}', [LocationController::class, 'search']);




// non-public
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/v1/user', [UserController::class, 'fetch']);
    Route::post('/v1/update-profile', [UserController::class, 'updateProfile']);
    Route::post('/v1/logout', [UserController::class, 'logout']);
    Route::post('/v1/delete', [UserController::class, 'delete']);
    Route::get('/v1/detail-profile', [UserController::class, 'detailProfile']);

    Route::get('/v1/internship/{internship_id}', [InternshipController::class, 'show']);
    Route::post('/v1/internship/user',[InternshipController::class,'listByUser']);
    Route::post('/v1/internship/', [InternshipController::class, 'store']);
    Route::put('/v1/internship/{internship_id}', [InternshipController::class, 'update']);
    Route::delete('/v1/internship/{internship_id}', [InternshipController::class, 'delete']);


});



