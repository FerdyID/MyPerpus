<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('pdf', function () {
    return view('pdfview');
});

Route::get('icon', function (){
    return view('icons');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/user', 'UserController');
Route::get('/downloadPDF', 'UserController@exportPDF');
Route::get('/downloadExcel', 'UserController@exportExcel');

Route::resource('/book', 'BookController');
Route::resource('/category', 'CategoryController');

