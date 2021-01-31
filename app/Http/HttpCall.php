<?php 

namespace App\Http;

use Illuminate\Support\Facades\Http;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HttpCall
{
    

    public static  function Tmdbget(string $url, string $query = '')
    {
        $local = LaravelLocalization::getCurrentLocale();
        $lang = strlen($query) > 0 ? "&language=".$local : "?language=".$local;

        return Http::withToken(config('services.tmdb.token'))
                ->get(config('services.tmdb.routeUrl').$url.$query.$lang)
                ->json();
    }
}