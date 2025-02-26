<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Requests\DeleteTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;



class TaskController extends Controller
{
    public function create(StoreTaskRequest $request)
    {
        Task::create(attributes: $request->validated());

        return redirect()->back()->with('status', 'Task added');
    }

    public function delete(DeleteTaskRequest $request)
    {
        Task::destroy($request->validated()['id']);

        return redirect()->back()->with('status', 'Task deleted');
    }

    public function edit(UpdateTaskRequest $request)
    {
        $task = Task::find($request->validated()['id']);

        $task->title = $request->validated()['title'];

        $task->save();

        return redirect()->back()->with('status', 'Task updated');
    }


}
