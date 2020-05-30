@extends('layouts.app')

@section('content')
  <div>
    <h1 class="heading is-l">Create a Project</h1>
    
    <form action="/projects" method="POST">
      @csrf
      <div class="field">
        <label for="title" class="label">Title</label>
        
        <div class="control">
          <input type="text" class="input" name="title" placeholder="Title" />
        </div>
      </div>
      
      <div class="field">
        <label for="title" class="label">Description</label>
        
        <div class="control">
          <textarea class="textarea" name="description" placeholder="Description"></textarea>
        </div>
      </div>
      
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link">Create Project</button>
          <a href="/projects">Cancel</a>
        </div>
      </div>
    </form>
  </div>
@endsection