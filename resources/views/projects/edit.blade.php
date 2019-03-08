@extends('layout')

@section('content')
    <h1 class="title">Edit project</h1>

    <form method="POST" action="/projects/{{ $project->id }}">
        @method('PATCH')
        @csrf
        <div class="field">
            <label class="label" for="title">Title</label>

            <div class="control">
                <input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title }}">            
            </div>
        </div>
        <div class="field">
            <label class="label" for="">Description</label>

            <textarea name="description" class="textarea">{{ $project->description }}</textarea>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button ls-link">Update Project</button>
            </div>
        </div>

    </form>
    @include('errors')
    <form method="POST" action="/projects/{{ $project->id }}">
        @method('DELETE')
        @csrf
        <div class="control ">
                <button type="submit" class="button ls-link">Delete Project</button>
        </div>
    </form>
@endsection