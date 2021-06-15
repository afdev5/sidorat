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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');
Route::resource('surat', 'SuratController');
Route::get('arsip', 'ArsipController@index')->name('arsip');
Route::get('arsip_cetak', 'ArsipController@cetak')->name('cetak.arsip');
Route::get('arsip_backup', 'ArsipController@backup')->name('arsip.backup');
Route::get('cetak_pdf/{id}', 'ArsipController@cetak_pdf')->name('arsip.cetak');


//Datatable
Route::get('/datatable_user', 'UserController@datatable')->name('datatable.user');
Route::get('/datatable_surat', 'SuratController@datatable')->name('datatable.surat');
Route::get('/datatable_arsip', 'ArsipController@datatable')->name('datatable.arsip');
