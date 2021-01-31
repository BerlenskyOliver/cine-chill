<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Searchcontroller extends Controller
{
    
    public function show(Request $request)
    {
        return view('search.index', ['query' => $request->get('q')]);
    }
}

