<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl my-3">
    <div>
      <div class="md:flex-shrink-0">
        @if ($result['type'] === 'keyword')
        @else
        <img class="h-48 w-full object-cover" src={{ $result['poster_path'] }} alt={{ $result['name'] }}>
        @endif
        
      </div>
      <div class=" p-8">
        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold pb-2">{{ Str::ucfirst($result['type']) }}</div>
        @if ($result['type'] === 'person' || $result['type'] === 'collection' || $result['type'] === 'keyword')
        @else
        <div class="uppercase tracking-wide text-sm text-gray-700 font-semibold">{{ $result['publish_date'] }}</div>
        @endif
      
        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $result['name'] }}</a>
        @if ($result['type'] === 'person' || $result['type'] === 'keyword')
        @else
        <p class="mt-2 text-gray-500">{{ substr($result['overview'], 2, 55). '...' }}</p>
        @endif
      </div>
    </div>
</div>