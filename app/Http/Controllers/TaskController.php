<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;
use Gate;
use App\Models\Task;
use Auth;


class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->paginate(3);

        return view('todo', [
            'tasks' => $tasks,
        ]);
    }

    public function create(StoreTaskRequest $request)
    {
        Auth::user()->tasks()->create([
            'title' => $request->validated()['title'],
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('status', 'Task added');
    }

    public function delete(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->back()->with('status', 'Task deleted');
    }

    public function edit(Request $request, Task $task)
    {
        Gate::authorize('update', $task);


        $task->update([
            'title' => $request->title,
        ]);

        return redirect()->back()->with('status', 'Task updated');
    }


}
