<div {{ $attributes->merge(['class' => 'mt-4']) }}>
    <a href="{{ route('tv.show', $tvshow['id']) }}">
        <img src="{{ $tvshow['poster_path'] }}" alt="" class="hover:opacity-75 transition ease-in-out duration-150 rounded-lg">
    </a>
    <div class="mt-2">
        <a href="{{ route('tv.show', $tvshow['id']) }}" class="mt-2 hover:text-gray:300">{{ $tvshow['name'] }}</a>
        <div>
            @foreach ($tvshow['genres'] as $key => $genre)
                @if($genre !== null)  
                    <a href="{{ route("tv.index"). "?category=$genre" }}" class="tag mini_tag">{{ $genre }}</a>
                @endif
            @endforeach
    </div>
        <div class="flex items-center text-gray-400 text-sm mt-1">
            <span>{{ $tvshow['first_air_date'] }}</span>
        </div>
    </div>
</div>