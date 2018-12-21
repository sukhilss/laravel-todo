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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Task related routes
Route::get('/tasks', 'ToDoController@index')->name('tasks');
Route::get('/tasks/new', 'ToDoController@create')->name('tasks-new');
Route::post('/tasks', 'ToDoController@store')->name('tasks-post');
Route::get('/tasks/{id}', 'ToDoController@show')->name('tasks-show');
Route::get('/tasks/{id}/edit', 'ToDoController@edit')->name('tasks-edit');
Route::put('/tasks/{id}', 'ToDoController@update')->name('tasks-put');
Route::delete('/tasks/{id}', 'ToDoController@destroy')->name('tasks-destroy');
Route::put('/tasks/{id}/complete', 'ToDoController@complete')->name('tasks-complete');
