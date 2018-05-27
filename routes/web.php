<?php


Route::get('/', function () {
    return view('welcome');
});

Route::get('/table','BookController@getTable')->name('book_table');
Route::get('/create','BookController@createForm')->name('create_book');
Route::get('/edit/{id}','BookController@edit')->name('edit_book');

Route::get('/book_cover/{cover}','BookController@getCoverPhoto')->name('cover_photo');

Route::post('/store','BookController@storeBook')->name('store_book');
Route::post('/update','BookController@update')->name('update_book');
Route::get('/delete/{id}','BookController@delete')->name('delete_book');
Route::get('/transaction','BookController@transaction')->name('book_transaction');

Route::get('/book/json','BookApiController@index')->name('book/json');

