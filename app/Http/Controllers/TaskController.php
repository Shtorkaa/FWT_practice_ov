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

        $statuses = array_column(status::cases(), 'value');

        return view('todo', [
            'tasks' => $tasks,
            'statuses' => $statuses,
        ]);
    }

    public function search(SearchTaskRequest $request)
    {
        $searchTitle = $request->validated()['search'];

        $searchStatus = $request->validated()['status'];

        $tasks = Auth::user()->tasks()
                            ->where('title', 'LIKE', "%{$searchTitle}%")
                            ->where('status', 'LIKE', "%{$searchStatus}%")
                            ->paginate(3);

        $statuses = array_column(status::cases(), 'value');


        return view('todo', [
            'tasks' => $tasks,
            'statuses' => $statuses,
        ]);
    }

    public function create(StoreTaskRequest $request)
    {
        Auth::user()->tasks()->create($request->validated());

        return redirect('todo');
    }

    public function delete(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect('todo');
    }

    public function edit(UpdateTaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        $task->update($request->validated());

        return redirect('todo');
    }


}
