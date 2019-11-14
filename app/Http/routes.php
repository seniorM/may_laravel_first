<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tasks', function() {
    return view('tasks');
});
//save task
Route::post('/tasks', function() {
    echo 'save task will be here';
});
//delete task
Route::delete('/tasks/{task}', function() {
    echo 'delete task will be here';
});
