<?php
if (!function_exists('is_route_active')) {
    function is_route_active($pattern)
    {
        return request()->is($pattern);
    }


    function getCurrentRoutePrefix()
    {
        return ltrim(request()->route()->getPrefix(), '/');
    }
}
