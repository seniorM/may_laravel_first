<?php

use Illuminate\Http\Request;
use App\Task;

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
//all tasks
Route::get('/tasks', function() {
    $tasks = Task::orderBy('created_at', 'desc')->get();
    return view('tasks', ['tasks' => $tasks]);
})->name('tasklist');
//save task
Route::post('/tasks', function(Request $request) {
    $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect(route('tasklist'))
                        ->withInput()
                        ->withErrors($validator);
    }
    $task = new Task();
    $task->name = $request->name;
    $task->save();
    return redirect(route('tasklist'));
})->name('savetask');
//delete task
Route::delete('/tasks/{task}', function(Task $task) {
    $task->delete();
    return redirect(route('tasklist'));
})->name('deletetask');
//edite task
Route::get(' /{task}/edit', function( Task $task) {
        return view('edit.update', ['task' => $task,]);
    })->name('tasks_edit');

Route::put('/{task}', function(Request $request, Task $task) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('tasks_edit', $task->id))
                            ->withInput()
                            ->withErrors($validator);
        }
        $task->name = $request->name;
        $task->save();
        return redirect(route('tasks_tasks'));
    })->name('tasks_update');