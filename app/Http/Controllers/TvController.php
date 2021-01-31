<?php

namespace App\Http\Controllers;

use App\Http\HttpCall;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $genres = Cache::remember('tv.genres', now()->addHours(5), function () {
            return HttpCall::Tmdbget('/genre/tv/list')['genres'];
        });
        if($request->get('category')){
            $tv_with_genre = [];
            foreach($genres as $genre){
                if(in_array($request->get('category'), $genre)){
                    $tv_with_genre = HttpCall::Tmdbget('/discover/tv', "?with_genres={$genre['id']}")['results'];
                }
            }
            $viewmodel = new TvViewModel(null, null, $genres, $tv_with_genre);
            return view('movies.index', $viewmodel);
        }else{
            $populartv = HttpCall::Tmdbget('/tv/popular')['results'];
            $topratedtv = HttpCall::Tmdbget('/tv/top_rated')['results'];
            $viewmodel = new TvViewModel($populartv,$topratedtv, $genres, null);
            return view('tv.index', $viewmodel);
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
        $tvshow = Cache::remember("single.tvhow.{$id}", now()->addHours(3), function () use($id) {
            return HttpCall::Tmdbget("/tv/{$id}", '?append_to_response=credits,videos,images');
        });
        $tvshowSimilar = HttpCall::Tmdbget("tv/{$id}/similar");
        if(!is_null($tvshowSimilar)){
            $tvshowSimilar = $tvshowSimilar['results'];
        }else{
            $tvshowSimilar = [];
        }
        $showModal  = request()->get('play') ? "true": "false";
        $viewmodel = new TvShowViewModel($tvshow, $tvshowSimilar, $showModal);
        return view('tv.show', $viewmodel);
    }
}
