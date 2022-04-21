<?php 

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\returnSelf;

if (!function_exists('load_img')) {
    /**
     * @param string $path
     * @param string $image_name
     * @return mixed
     * @author Duy
     */
    function load_img($path, $image_name)
    {
        if (!empty($image_name)) {
            return asset($path. '/' . $image_name);
        }
        return asset('image/400x400.jpg');
    }
}

if (! function_exists('isCurrentController')) {
    function isCurrentController($names)
    {
        $names = array_map('trim', explode(',', $names));
        return in_array(\Route::currentRouteName(), $names, true);
    }
}

if (! function_exists('category_type')) {
     /**
     * @param int $type_number
     * @return mixed
     * @author Duy
     * 
     * Convert type number to type text
     */
    function category_type($type_number)
    {
        if($type_number == 1){
            return '<span class="type-1">Kiến thức cơ bản</span>';
        }
        else if($type_number==2) {
            return '<span class="type-2">Chia sẻ</span>';
        }
        else {
            return 'Không tìm thấy loại danh mục';
        }
    }
}