<?php

namespace App\Http\Controllers;

use App\Http\HttpCall;
use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;

class Actorscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        $popularactors = HttpCall::Tmdbget('/person/popular', "?page=$page")['results'];

        $viewmodel = new ActorsViewModel($popularactors, $page);

        return view('actors.index', $viewmodel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $actor = HttpCall::Tmdbget("/person/{$id}");
        $social = HttpCall::Tmdbget("/person/{$id}/external_ids");
        $credits = HttpCall::Tmdbget("/person/{$id}/combined_credits");
        $viewmodel = new ActorViewModel($actor, $social, $credits);
        return view('actors.show', $viewmodel);
    }
}
