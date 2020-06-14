@extends('layouts.app')

@section('content')
  <div class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow">
    <h1 class="text-2xl font-normal mb-10 text-center">Create a Project</h1>
    
    <form action="/projects" method="POST">
      @csrf
      <div class="field mb-6">
        <label for="title" class="label text-sm mb-2 block">Title</label>
        
        <div class="control">
          <input type="text" class="input bg-transparent border border-muted-light rounded p-2 text-xs w-full" name="title" placeholder="Title" />
        </div>
      </div>
      
      <div class="field mb-6">
        <label for="title" class="label text-sm mb-2 block">Description</label>
        
        <div class="control">
          <textarea class="textarea bg-transparent border border-muted-light rounded p-2 text-xs w-full" rows="10" name="description" placeholder="Description"></textarea>
        </div>
      </div>
      
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link mr-2">Create Project</button>
          <a href="/projects" class="text-default">Cancel</a>
        </div>
      </div>
    </form>
  </div>
@endsection