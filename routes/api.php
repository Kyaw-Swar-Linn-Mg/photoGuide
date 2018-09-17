<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// api for basic photography

Route::get('/basic_photography','BasicPhotographyController@index');

// api for landscape photography

Route::get('/landscape_photography','LandscapePhotographyController@index');

// api for portrait_photography

Route::get('/portrait_photography','PortraitPhotographyController@index');

// api for category and post

Route::get('/post','PostController@index');
