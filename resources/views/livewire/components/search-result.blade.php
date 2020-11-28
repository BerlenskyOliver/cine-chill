<div class="search-results">
    <div class="flex justify-between flex-wrap py-4">
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Results for: {{ $query }}</h2>
        @livewire('components.select')
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8">
        @foreach ($results->searchResults as $result)
            @if ($result === null)
            @else
                @livewire('single-result', ['result' => $result], key(time().$result['id']))
            @endif
            
        @endforeach
    </div>
</div>