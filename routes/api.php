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
Route::get('/v1/internship/{internship_id}', [InternshipController::class, 'show']);
Route::post('/v1/internship/{user_id}', [InternshipController::class, 'store']);
Route::put('/v1/internship/{internship_id}', [InternshipController::class, 'update']);
Route::delete('/v1/internship/{internship_id}', [InternshipController::class, 'destroy']);
Route::get('/v1/internship/search/{name}', [InternshipController::class, 'search']);
//filter
Route::get('/v1/internship/user/{user_id}',[InternshipController::class,'listByUser']);
Route::get('/v1/internship/tag/{tag_id}', [InternshipController::class, 'listByTag']);
Route::get('/v1/internship/location/{location_id}', [InternshipController::class, 'listByLocation']);
Route::get('/v1/internship/isPaid/{isPaid}', [InternshipController::class, 'listByIsPaid']);
Route::get('/v1/internship/isWfh/{isWfh}', [InternshipController::class, 'listByIsWfh']);

//TAG
Route::get('/v1/tag', [TagController::class, 'index']);
Route::get('/v1/tag/search/{name}', [TagController::class, 'search']);

//LOCATION
Route::get('/v1/location', [LocationController::class, 'index']);
Route::get('/v1/location/search/{name}', [LocationController::class, 'search']);




// non-public
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('update-profile', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('delete', [UserController::class, 'delete']);
    Route::get('detail-profile', [UserController::class, 'detailProfile']);


});



