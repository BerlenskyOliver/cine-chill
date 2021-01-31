@extends('layouts.main')

@section('content')
   
    <header class="banner bg-center bg-cover"
        style="background-image: url({{ $netflixoriginal['backdrop_path'] }})">
            <div class="banner_contents">
                <h1 class="text-xl pb-4 font-semibold">
                    {{ $netflixoriginal['original_name'] }}
                </h1>
                <div class="banner_buttons">
                    <a href="{{ route('tv.show', $netflixoriginal['id'])."?play=true" }}" class="banner_button">Play</a>
                    <button class="banner_button">My list</button>
                </div>
                <h1 class="pt-4 font-semibold text-lg max-w-2xl">{{ $netflixoriginal['overview'] }}</h1>
            </div>

            <div class="banner_fadeBottom" />
    </header>
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular movies</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularmovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>

        <div class="now-playing-movies py-24">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular series</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularseries as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div>
    </div>
@endsection