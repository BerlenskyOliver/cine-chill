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
            <div class="movies_with_genre">
                <h2 class="uppercase tracking-wider text-lg font-semibold">Results for : {{ request()->get('category') }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($movies_with_genre as $movie)
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

        @if (!empty($popularmovies))
            <div class="popular-movies">
                <h2 class="uppercase tracking-wider  text-lg font-semibold">Popular movies</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($popularmovies as $movie)
                        <x-movie-card :movie="$movie" class='popular-movie'/>
                    @endforeach
                </div>
            </div>
        @endif
        
    </div>
    <div class="page-load-status my-4">
        <div class="flex justify-center">
            <svg width="24" height="24" class="text-gray-400 w-5 infinite-scroll-request spinner my-8  text-4xl" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" color="#000"><g transform="translate(1 1)" stroke-width="2" fill="none" fill-rule="evenodd"><circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle><path d="M36 18c0-9.94-8.06-18-18-18"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform></path></g></svg>
        </div>
        
        <p class="infinite-scroll-last">End of content</p>
        <p class="infinite-scroll-error">Error</p>
    </div>
@endsection

@section('scripts')
    
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var ele = document.querySelector('.popular-movies .grid');
        var infScroll = new InfiniteScroll(ele, {
        // options
            path: '/movies/page/@{{#}}',
            append: '.popular-movie',
            status: '.page-load-status'
        });
    </script>
@endsection