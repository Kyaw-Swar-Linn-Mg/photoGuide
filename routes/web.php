<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout','HomeController@logout')->name('logout');

// basic_photography

Route::get('/basic_photo','BasicPhotographyController@get_basic_photo_table')->name('basic_photo');

Route::get('/create_basic_photo','BasicPhotographyController@get_create_basic_photo')->name('create_basic_photo');

Route::post('/store_basic_photo','BasicPhotographyController@store')->name('store_basic_photo');

Route::get('/delete_basic_photo/{id}','BasicPhotographyController@delete')->name('delete_basic_photo');

Route::get('/update_basic_photo/{id}','BasicPhotographyController@edit')->name('edit_basic_photo');

Route::post('/update_basic_photo','BasicPhotographyController@update')->name('update_basic_photo');

Route::post('/remove_basic_photo','BasicPhotographyController@removePhoto');

// landscape_photography

Route::get('/landscape_photo','LandscapePhotographyController@get_landscape_photo_table')->name('landscape_photo');

Route::get('/create_landscape_photo','LandscapePhotographyController@get_create_landscape_photo')->name('create_landscape_photo');

Route::post('/store_landscape_photo','LandscapePhotographyController@store')->name('store_landscape_photo');

Route::get('/delete_landscape_photo/{id}','LandscapePhotographyController@delete')->name('delete_landscape_photo');

Route::get('/update_landscape_photo/{id}','LandscapePhotographyController@edit')->name('edit_landscape_photo');

Route::post('/update_landscape_photo','LandscapePhotographyController@update')->name('update_landscape_photo');

Route::post('/remove_landscape_photo','LandscapePhotographyController@removePhoto');

// portrait photography

Route::get('/portrait_photo','PortraitPhotographyController@get_portrait_photo_table')->name('portrait_photo');

Route::get('/create_portrait_photo','PortraitPhotographyController@get_create_portrait_photo')->name('create_portrait_photo');

Route::post('/store_portrait_photo','PortraitPhotographyController@store')->name('store_portrait_photo');

Route::get('delete_portrait_photo/{id}','PortraitPhotographyController@delete')->name('delete_portrait_photo');

Route::get('/update_portrait_photo/{id}','PortraitPhotographyController@edit')->name('edit_portrait_photo');

Route::post('/update_portrait_photo','PortraitPhotographyController@update')->name('update_portrait_photo');

Route::post('/remove_portrait_photo','PortraitPhotographyController@removePhoto');

// create category

Route::get('/category','CategoryController@category_form')->name('category');

Route::post('/store_category','CategoryController@store')->name('store_category');

// create post

Route::get('/post','PostController@post_form')->name('post');

Route::post('/store_post','PostController@store')->name('store_post');

Route::get('/post_table','PostController@get_post_table')->name('post_table');

Route::get('/delete_post/{id}','PostController@delete')->name('delete_post');

Route::get('/update_post/{id}','PostController@edit')->name('edit_post');

Route::post('/update_post','PostController@update')->name('update_post');

Route::post('/remove_post','PostController@removePhoto');
