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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/userdata', 'UserController@CreateUserdata');
Route::get('/', 'UserController@ReadData');
Route::get('/edit-users/{id}', 'UserController@edit_users');
Route::post('/update-users', 'UserController@updateusers');
Route::get('/delete-users/{id}', 'UserController@deleteusers');

//Invest

Route::get('/invest', 'UserController@Invest');



