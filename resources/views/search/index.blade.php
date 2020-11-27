@extends('layouts.main')

@section('content')

    <div class="container mx-auto px-4 pt-16">
        <div class="mx-auto my-5">
            @livewire('search-dropdown')
        </div>
        @livewire('components.search-result', ['query' => $query])
    </div>

@endsection