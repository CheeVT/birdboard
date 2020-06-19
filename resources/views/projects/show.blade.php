@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
  <div class="w-full">
    <p class="text-gray-500 text-sm font-normal">
      <a href="/projects">My projects</a> / {{ $project->title }}
    </p>
  </div> 
  <div class="text-right w-full">
    <a href="{{ $project->path() }}/edit" class="button">Edit project</a>
  </div>  
</header>

<main>
  <div class="lg:flex -mx-3">
    <div class="lg:w-3/4 px-3">
      <div class="mb-8">
        <h2 class="text-gray-500 text-lg font-normal mb-3">Tasks</h2>
        @forelse($project->tasks as $task)
          <div class="card mb-3">
            <form method="POST" action="{{ $task->path() }}">
              @method('PATCH')
              @csrf

              <div class="flex">
                <input type="text" name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-500' : '' }}">
                <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
              </div>
            </form>
          </div>
        @empty
          <div class="card mb-3">
            There is no tasks yet!
          </div>
        @endforelse
        <div class="card mb-3">
            <form action="{{ $project->path() . '/tasks' }}" method="POST">
              @csrf
              <input type="text" name="body" placeholder="Add a new task..." class="w-full" />
            </form>
          </div>
      </div>
      <div class="mb-6">
        <h2 class="text-gray-500 text-lg font-normal mb-3">General notes</h2>
        <form method="POST" action="{{ $project->path() }}">
          @csrf
          @method('PATCH')
          <textarea name="notes" rows="10" class="card w-full mb-4" placeholder="Anything special that you want to make a note of?">{{ $project->notes }}</textarea>
          <button type="submit" class="button">Save</button>
        </form>

        @include('errors')
      </div>
    </div>

    <div class="lg:w-1/4 px-3">
      @include('projects._card')
  </div>
  
  
  
</main>
@endsection
