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

Route::get('/', function () {
    return view('coba');
});

Route::get('api/check_csrf/{kode}', 'Auth@check_csrf');

Route::post('api/login_user', 'Auth@login');
Route::post('api/register_user', 'Auth@register');
Route::post('api/login_member', 'Member@login');
Route::post('api/register_member', 'Member@register');