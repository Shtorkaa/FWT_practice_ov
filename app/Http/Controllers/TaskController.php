<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\task;

class TaskController extends Controller
{
    public function addTask(Request $request){
        DB::table('tasks')->insert([
            'title' => $request->title,
        ]);
        return redirect()->back()->with('status', 'Task added');
    }

    public function deleteTask(Request $request){
        Task::destroy($request->id);
        return redirect()->back()->with('status', 'Task deleted');
    }

    public function editTask(Request $request){
        DB::table('tasks')
            ->where('id', $request->id)
            ->update(['title' => $request->title]);
        return redirect()->back()->with('status' , 'Task updated');
    }


}
