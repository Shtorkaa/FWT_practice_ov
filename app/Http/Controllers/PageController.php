<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $tasks = task::all();
        return view('todo', [
            'tasks' => $tasks,
        ]);
    }
}
