<?php

namespace App\Http\Controllers;

use App\Http\HttpCall;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Moviescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $genres = Cache::remember('movies.genres', now()->addHours(5), function () {
            return HttpCall::Tmdbget('/genre/movie/list')['genres'];
        });
        if($request->get('category')){
            $movies_with_genre = [];
            foreach($genres as $genre){
                if(in_array($request->get('category'), $genre)){
                    $movies_with_genre = HttpCall::Tmdbget('/discover/movie', "?with_genres={$genre['id']}")['results'];
                }
            }
            $viewmodel = new MoviesViewModel(null, null, $genres, $movies_with_genre);
            return view('movies.index', $viewmodel);
        }else{
            $popularmovies = HttpCall::Tmdbget('/movie/popular')['results'];
            $now_playingmovies = HttpCall::Tmdbget('/movie/now_playing')['results'];
            $viewmodel = new MoviesViewModel($popularmovies, $now_playingmovies, $genres, null);
            return view('movies.index', $viewmodel);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $movie = Cache::remember("singele.movie.{$id}", now()->addHours(3), function () use($id) {
            return HttpCall::Tmdbget("/movie/{$id}", "?append_to_response=credits,videos,images");
        });

        $movieSimilar = HttpCall::Tmdbget("/movie/{$id}/similar");
        if(!is_null($movieSimilar)){
            $movieSimilar = $movieSimilar['results'];
        }else{
            $movieSimilar = [];
        }      
        $viewmodel = new MovieViewModel($movie, $movieSimilar);   
        return view('movies.show', $viewmodel);
    }

}
