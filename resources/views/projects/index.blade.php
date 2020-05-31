@extends('layouts.app')

@section('content')
<div class="flex items-center mb-3">
  <h1 class="mr-auto">Projects</h1>
  <a href="/projects/create">New project</a>
</div>

  <div class="flex">
    @forelse($projects as $project)
      <div class="bg-white mr-4 p-3 rounded shadow w-1/3">
        <a href="{{ $project->path() }}">
          <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>
        </a>

        <div class="text-gray-500">
          {{ Str::limit($project->description, 100) }}
        </div>
      </div>
    @empty
      <div>No projects yet.</div>
    @endforelse
    </div>
@endsection