@extends('layouts.app')

@section('content')
<header class="flex items-center mb-3 py-4">
  <div class="flex justify-between items-end w-full">
    <h2 class="text-gray-500 text-sm font-normal">My projects</h2>
    <a href="/projects/create" class="button">New project</a>
  </div>  
</header>

<main>
  <div class="lg:flex lg:flex-wrap -mx-3">
    @forelse($projects as $project)
    <div class="lg:w-1/3 px-3 pb-6">
      @include('projects._card')        
    </div>
    @empty
      <div>No projects yet.</div>
    @endforelse
  </div>
</main>
@endsection