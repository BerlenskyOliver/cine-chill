<?php

namespace App\Http\Controllers;

use App\Http\HttpCall;
use App\ViewModels\HomeViewModel;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $trending = Http::withToken(config('services.tmdb.token'))
        //     ->get('https://api.themoviedb.org/3/trending/all/week?language=fr-FR')
        //     ->json()['results'];
        // dd($trending);
        $moviegenres = Cache::remember('movies.genres', now()->addHours(5), function () {
            return HttpCall::Tmdbget('/genre/movie/list')['genres'];
        });
        $tvgenres = Cache::remember('tv.genres', now()->addHours(5), function () {
            return HttpCall::Tmdbget('/genre/tv/list')['genres'];
        });
        $netflixoriginal = HttpCall::Tmdbget('/discover/tv', '?with_network=213')['results'][rand(0, 19)];
        $popularmovies = HttpCall::Tmdbget('/movie/popular')['results'];
        $upcomingmovies = HttpCall::Tmdbget('/movie/upcoming')['results'];
        
        $ontheairseries = HttpCall::Tmdbget('/tv/on_the_air')['results'];
        $popularseries = HttpCall::Tmdbget('/tv/popular')['results'];

        $viewmodel = new HomeViewModel(
                                $popularmovies, 
                                $popularseries, 
                                $moviegenres, 
                                $tvgenres, 
                                $netflixoriginal,
                                $upcomingmovies,
                                $ontheairseries
                            );
    
        return view('home', $viewmodel);
    }

}
