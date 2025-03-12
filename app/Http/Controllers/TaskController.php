<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\SearchTaskRequest;
use Illuminate\Http\Request;
use App\Enums\Status;
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

    public function search(SearchTaskRequest $request)
    {
        $searchTitle = $request->validated()['search'];

        $tasks = Auth::user()->tasks()->where('title', 'LIKE', "%{$searchTitle}%")->paginate(3);

        return view('todo', [
            'tasks' => $tasks,
        ]);
    }

    public function create(StoreTaskRequest $request)
    {
        Auth::user()->tasks()->create($request->validated());

        return redirect()->back();
    }

    public function delete(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->back();
    }

    public function edit(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $task->update($request->validated());

        return redirect()->back();
    }


}
