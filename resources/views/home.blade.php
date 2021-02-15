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
    
    <div class="upcoming-movies pt-16">
        <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold px-4">Upcoming movies</h2>
        <div>
            <div class="flex overflow-y-hidden overflow-x-scroll p-4 mx-4">
                @foreach ($upcomingmovies as $upcomingmovie)
                    <div class="mt-4 transform hover:scale-110 transition duration-200 {{ !$loop->first ? 'ml-4': '' }} relative" style="width: 300px;min-width: 300px;max-width:300px;">
                        <a href="{{ route('movie.show', $upcomingmovie['id']) }}">
                            <img src="{{ $upcomingmovie['poster_path'] }}" alt="" class="hover:opacity-750 transition ease-in-out duration-150 rounded-lg h-48 w-full object-cover">
                        </a>
                        <p class="absolute bottom-2 left-2 text-xl font-semibold">{{ $upcomingmovie['title'] }}</p>
                        <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <svg class="w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#fff"><path d="M9.5 15.584V8.416a.5.5 0 01.77-.42l5.576 3.583a.5.5 0 010 .842l-5.576 3.584a.5.5 0 01-.77-.42z"></path><path fill-rule="evenodd" d="M12 2.5a9.5 9.5 0 100 19 9.5 9.5 0 000-19zM1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12z"></path></svg>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4">
        {{-- $ontheairseries  --}}
        <div class="popular-movies pt-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">Popular movies</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularmovies as $movie)
                    <x-movie-card :movie="$movie"/>
                @endforeach
            </div>
        </div>
    </div>
    <div class="ontheairseries pt-16">
        <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold px-4">On The Air Series</h2>
        <div>
            <div class="flex overflow-y-hidden overflow-x-scroll p-4 mx-4">
                @foreach ($ontheairseries as $ontheairserie)
                    <div class="mt-4 transform hover:scale-110 transition duration-200 {{ !$loop->first ? 'ml-4': '' }} relative" style="width: 300px;min-width: 300px;max-width:300px;">
                        <a href="{{ route('tv.show', $ontheairserie['id']) }}">
                            <img src="{{ $ontheairserie['poster_path'] }}" alt="" class="hover:opacity-750 transition ease-in-out duration-150 rounded-lg h-48 w-full object-cover">
                        </a>
                        <p class="absolute bottom-2 left-2 text-xl font-semibold">{{ $ontheairserie['original_name'] }}</p>
                        <span class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                            <svg class="w-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" color="#fff"><path d="M9.5 15.584V8.416a.5.5 0 01.77-.42l5.576 3.583a.5.5 0 010 .842l-5.576 3.584a.5.5 0 01-.77-.42z"></path><path fill-rule="evenodd" d="M12 2.5a9.5 9.5 0 100 19 9.5 9.5 0 000-19zM1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12z"></path></svg>
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="container mx-auto px-4">
        <div class="popular-series py-12">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">Popular series</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularseries as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div>
    </div>
@endsection