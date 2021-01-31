@extends('layouts.main')


@section('content')

    <div class="container mx-auto px-4 pt-28">
        <div class="mx-auto my-5">
            @livewire('search-dropdown')
        </div>
        <h2 class=" tracking-wider  text-lg font-semibold">Category</h2>
        <div class="genres py-6">
          
            @foreach ($genres as $key =>  $genre)
                <a href={{ route("tv.index")."?category=$genre" }} class="tag big_tag">{{ $genre }}</a>
            @endforeach
        </div>
        
        @if (empty($tv_with_genre) && request()->get('category'))
            <h2 class="uppercase tracking-wider text-2xl font-semibold">Don't Have nothing for : {{ request()->get('category') }}</h2>
        @endif
        @if (!empty($tv_with_genre) && request()->get('category'))
            <div class="popular-tv">
                <h2 class="uppercase tracking-wider text-lg font-semibold">Results for : {{ request()->get('category') }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($tv_with_genre as $$tvshow)
                            <x-tv-card :tvshow="$tvshow" />
                    @endforeach
                </div>
            </div>
        @endif
        
        @if (!empty($populartv))
            <div class="popular-tv">
                <h2 class="uppercase tracking-wider  text-lg font-semibold">Popular shows</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                    @foreach ($populartv as $tvshow)
                        <x-tv-card :tvshow="$tvshow" />
                    @endforeach
                </div>
            </div>
        @endif

        @if (!empty($topratedtv))
        <div class="now-playing-tv py-24">
            <h2 class="uppercase tracking-wider  text-lg font-semibold">Top Rated show</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($topratedtv as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
    
@endsection