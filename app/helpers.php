<?php


if(!function_exists('isRouteActive')){
    function isRouteActive($route){
        return url()->current() === $route ? 'navbar-active' : '';
    }
}
