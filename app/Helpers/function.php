<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

if (!function_exists('load_img')) {
    /**
     * @param string $path
     * @param string $image_name
     * @return mixed
     * @author Minh Hao
     */
    function load_img($path, $image_name)
    {
        if (!empty($image_name)) {
            return asset($path. '/' . $image_name);
        }
        return asset('image/400x400.jpg');
    }
}