<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        // $this->validate([
        //     'body' => 'required|max:500'
        // ]);
        
        return Task::create([ 'body' => request('body') ]);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        Task::findOrFail($task)->update([ 'body' => request('body') ]);
    }

    public function destroy(Task $task)
    {
        Task::delete($task);
        return 204;
    }
}
