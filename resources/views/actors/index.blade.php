@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-28">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular actors</h2>
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularactors as $actor)
                    <div class="actor mt-8 ">
                        <a href="{{ route('actors.show', $actor['id']) }}">
                            <img src=" {{ $actor['profile_path'] }}" 
                            class="hover:opacity-75 transition ease-in-out duration-150"
                            alt="">
                        </a>
                        <div class="mt-2">
                            <a href="{{ route('actors.show', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $actor['known_for']  }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="page-load-status my-4">
            <div class="flex justify-center">
                {{-- <p class="infinite-scroll-request spinner my-8  text-4xl">&nbsp;</p> --}}
               
                <svg width="24" height="24" class="text-white w-6 infinite-scroll-request my-8" viewBox="0 0 38 38" xmlns="http://www.w3.org/2000/svg" stroke="currentColor" color="#000"><g transform="translate(1 1)" stroke-width="2" fill="none" fill-rule="evenodd"><circle stroke-opacity=".5" cx="18" cy="18" r="18"></circle><path d="M36 18c0-9.94-8.06-18-18-18"><animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"></animateTransform></path></g></svg>
           
            </div>
            
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
@endsection

@section('scripts')
    
    <script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        var ele = document.querySelector('.grid');
        var infScroll = new InfiniteScroll(ele, {
        // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
        });
    </script>
@endsection