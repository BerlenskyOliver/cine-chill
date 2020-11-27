<?php

namespace App\Http\Controllers;

use App\ViewModels\SearchViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    
    public function show(Request $request)
    {
        return view('search.index', ['query' => $request->get('q')]);
    }
}

