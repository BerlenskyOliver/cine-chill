<div {{ $attributes->merge(['class' => 'mt-4']) }}>
   
    <a href="{{ route('movie.show', $movie['id']) }}">
        <img src="{{ $movie['poster_path'] }}" alt="" class="hover:opacity-750 transition ease-in-out duration-150 rounded-lg">
    </a>
    <div class="mt-2">
        <a href="{{ route('movie.show', $movie['id']) }}" class="text-md mt-2 hover:text-gray:300">{{ $movie['title'] }}</a>
        <div>     
            @foreach ($movie['genres'] as $key =>  $genre)
                @if($genre !== null)  
                    <a href="{{ route("movies.index")."?category=$genre" }}" class="tag mini_tag">{{ $genre }}</a>
                @endif
            @endforeach
        </div>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>{{ $movie['release_date'] }}</span>
        </div>
    </div>
</div>