<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function update(Task $task){
        // if (request()->has('completed')){
        //     $task->complete();
        // }
        // else{
        //     $task->incomplete();
        // }

        // request()->has('completed') ? $task->complete() : $task->incomplete();

        $method = request()->has('completed') ? 'complete' : 'incomplete';
        $task->$method();

        return back();
    }
    public function store(Project $project){
        $attributes = request()->validate(['description' => 'required']);
        $project->addTask($attributes);
 
        return back();
    }
}
