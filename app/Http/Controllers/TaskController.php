<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use Auth;


class TaskController extends Controller
{
    public function create(StoreTaskRequest $request)
    {        
        Task::create([
            'title' => $request->validated()['title'],
            'user_id' => Auth::user()->id,
        ]);
        
        return redirect()->back()->with('status', 'Task added');
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('status', 'Task deleted');
    }

    public function edit(Request $request,  Task $task)
    {
        $task->title = $request->title;

        $task->save();

        return redirect()->back()->with('status', 'Task updated');
    }


}
