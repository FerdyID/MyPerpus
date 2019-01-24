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

Route::get('icon', function (){
    return view('icons');
});
Route::get('email', function () {
    return view('emails.notifikasipass');
});

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/user', 'UserController');
Route::get('/downloadPDF', 'UserController@exportPDF');
Route::get('/downloadExcel', 'UserController@exportExcel');

Route::resource('/book', 'BookController');

Route::resource('/member', 'MemberController');

Route::resource('/transaction', 'TransactionController');

Route::get('/laporan/trs', 'LaporanController@transaction');
Route::get('/laporan/trs/pdf', 'LaporanController@transPdf');
Route::get('/laporan/trs/excel', 'LaporanController@transExcel');

Route::get('/laporan/book', 'LaporanController@book');
Route::get('/laporan/book/pdf', 'LaporanController@bookPdf');
Route::get('/laporan/book/excel', 'LaporanController@bookExcel');

