<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:500'
        ]);

        return Task::create([ 'body' => request('body') ]);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return 204;
    }
}
