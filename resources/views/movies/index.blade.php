@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-28 pb-12">
        <div class="mx-auto my-5">
            @livewire('search-dropdown')
        </div>
        <h2 class=" tracking-wider text-lg font-semibold">Category</h2>
        <div class="genres py-6">
            @foreach ($genres as $key =>  $genre)
                <a href={{ route("movies.index")."?category=$genre" }} class="tag big_tag">{{ $genre }}</a>
            @endforeach
        </div>
        
        @if (empty($movies_with_genre) && request()->get('category'))
            <h2 class="uppercase tracking-wider text-2xl font-semibold">Don't Have nothing for : {{ request()->get('category') }}</h2>
        @endif
        @if (!empty($movies_with_genre) && request()->get('category'))
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider text-lg font-semibold">Results for : {{ request()->get('category') }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($movies_with_genre as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach
                </div>
            </div>
        @endif

        @if (!empty($popularmovies))
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider  text-lg font-semibold">Popular movies</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($popularmovies as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach
                </div>
            </div>
        @endif
        
        
        @if(!empty($now_playingmovies))
            <div class="now-playing-movies py-24">
                <h2 class="uppercase tracking-wider  text-lg font-semibold">Now Playing</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($now_playingmovies as $movie)
                        <x-movie-card :movie="$movie" />
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
