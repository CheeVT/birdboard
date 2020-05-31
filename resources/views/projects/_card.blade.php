<div class="card">
  <a href="{{ $project->path() }}">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-300 pl-4">{{ $project->title }}</h3>
  </a>

  <div class="text-gray-500">
    {{ Str::limit($project->description, 100) }}
  </div>
</div>