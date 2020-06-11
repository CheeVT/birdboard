@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
  <div class="flex justify-between items-end w-full">
    <p class="text-gray-500 text-sm font-normal">
      <a href="/projects">My projects</a> / {{ $project->title }}
    </p>
  </div>  
</header>

<main>
  <div class="lg:flex -mx-3">
    <div class="lg:w-3/4 px-3">
      <div class="mb-8">
        <h2 class="text-gray-500 text-lg font-normal mb-3">Tasks</h2>
        @forelse($project->tasks as $task)
          <div class="card mb-3">{{ $task->body }}</div>
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
        <textarea name="" id="" cols="30" rows="10" class="card w-full">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus cum facere nesciunt hic. Excepturi perferendis maxime non culpa aut magni!</textarea>
      </div>
    </div>

    <div class="lg:w-1/4 px-3">
      @include('projects._card')
  </div>
  
  
  
</main>
@endsection
