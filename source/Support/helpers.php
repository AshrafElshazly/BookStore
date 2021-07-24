<?php

if(!function_exists('w_assets')) {
    function w_assets($path)
    {
        echo URL .'assets/web/'. $path ;
    }
}

if(!function_exists('a_assets')) {
    function a_assets($path)
    {
        echo URL .'assets/admin/'. $path ;
    }
}

if(!function_exists('uploads')) {
    function uploads($path)
    {
        echo URL .'uploads/'. $path ;
    }
}

if(!function_exists('url')) {
    function url($path = '')
    {
        echo URL . $path ;
    }
}
