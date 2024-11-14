<?php

/** Set Sidebar Active */

if(!function_exists('setSidebarActive')){
    function setSidebarActive(array $routes): string|null{
        foreach($routes as $route){
            if(request()->routeIs($route)){
                return 'active';
            }
        }
        return null;
    }
}

// Get Youtube Thumbnail
if(!function_exists('getThumbnail')){
    function getThumbnail(string $url): string|null
    {
       $pattern = '/[?&]v=([a-zA-Z0-9_-]{11})/';

       if(preg_match($pattern,$url,$matches)){
            $id = $matches[1];

            return "https://img.youtube.com/vi/$id/mqdefault.jpg";
       }
       return null;
    }
}

if(!function_exists('truncate')){
    function truncate(string $text, int $limit = 25)
    {
        return \Str::of($text)->limit($limit);
    }
}


