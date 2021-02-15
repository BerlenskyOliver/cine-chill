<div class="relative mt-3 md:mt-0" x-data="{ isOpen: false}" @click.away="isOpen = false">
    <form method="GET" action={{ route('search') }}>
        <input wire:model.debounce.500ms="q" type="text"  
        class="bg-gray-800 rounded-full w-full px-4 pl-8 py-1 focus:outline-none focus:shadow-outline" 
        placeholder="Search"
        autocomplete="off"
        name="q"
        x-ref="q"
        @keydown.window= "
        if(event.keyCode === 191){event.preventDefault(); $refs.q.focus();}"
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
        >

        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
        </div>
        <div wire:loading class="absolute top-0 right-0 mr-2 my-1">
            <svg width="24" height="24" class="text-gray-400 w-5" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" color="#000"><g transform="translate(1 1)" stroke-width="2" fill="none" fill-rule="evenodd"><circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle><path d="M36 18c0-9.94-8.06-18-18-18"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform></path></g></svg>
        </div>
    </form>

    @if(strlen($q) > 2)
        <div class="z-50 absolute bg-gray-800 rounded w-full mt-4"
        x-show.transition.opacity="isOpen"
        
        >
            @if($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movie.show', $result['id']) }}" class="hover:bg-gray-700 px-3 py-3 flex items-center transition ease-in-out
                            duration-150"
                            @if($loop->last) @keydown.tab="isOpen = false" @endif
                            >
                                @if($result['poster_path'])
                                    <img src="{{ 'https://image.tmdb.org/t/p/w92'.$result['poster_path'] }}"  class="w-8" alt="poster">
                                @else
                                    <img src="https://via.placeholder.com/50x75" class="w-8" alt="">
                                @endif
                                    <span class="text-white ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for *{{ $q }}*</div>
            @endif           
        </div>
    @endif
</div>