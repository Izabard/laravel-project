<?php

namespace App\Http\Controllers;

use App\Project;
use App\Events\ProjectCreated;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
        return view('projects.index',[
            'projects' => auth()->user()->projects
        ]);
    }
    public function create()
    {
        return view('projects.create');
    }
    public function store()
    {
        $attributes =  $this->validateProject();
        $attributes['owner_id'] = auth()->id();    
        $project = Project::create($attributes);
        
        flash("Your project has been created");
        return redirect('/projects');
    }
    public function edit(Project $project){
        
        return view('projects.edit', compact('project'));
    }
    public function update(Project $project){
        $attributes = request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3']
        ]);
        
        $project->update($this->validateProject());

        return redirect('/projects');
    }
    public function destroy(Project $project){
        $project->delete();

        return redirect('/projects');
    }
    public function show(Project $project){
       // abort_unless(auth()->user()->owns($project),403);
       // abort_if($project->owner_id !== auth()->id(), 403);
      /*  if (\Gate::denies('update', $project)) {
           abort(403);
       } */
        $this->authorize('update', $project); 
       
        return view('projects.show', compact('project'));
    }
    public function validateProject(){
        return request()->validate([
            'title'=>['required', 'min:3'],
            'description'=>['required', 'min:3']
        ]);
    }

}
