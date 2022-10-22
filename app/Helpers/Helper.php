<?php

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

if (!function_exists('devAdminEmail')) {
    function devAdminEmail()
    {
        return 'dev.admin@shafi95.com';
    }
}

if(!function_exists('bdDate')){
    function bdDate($date){
        return Carbon::parse($date)->format('d/m/Y');
    }
}

if(!function_exists('ageWithDays')){
    function ageWithDays($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }
}
if(!function_exists('ageWithMonths')){
    function ageWithMonths($d_o_b){
        return Carbon::parse($d_o_b)->diff(Carbon::now())->format('%y years, %m months');
    }
}

if(!function_exists('permissionText')){
    function permissionText($permission){
        switch($permission){
            case 0;
                $permission = 'No Login Permission';
                break;
            case 1;
                $permission = 'Admin';
                break;
            case 2;
                $permission = 'Creator';
                break;
            case 3;
                $permission = 'Editor';
                break;
            case 4;
                $permission = 'Viewer';
                break;
        }
        return $permission;
    }
}

if(!function_exists('profileImg')){
    function profileImg(){
        if(file_exists(asset('files/images/user/'.user()->image))){
            return asset('uploads/images/user/'.user()->image);
        }else{
            return asset('uploads/images/user/logo.jpg');
        }
    }
}

if (!function_exists('userCan')) {
    function userCan($permission)
    {
        if (auth()->check() && user()->can($permission)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('readableSize')) {
    function readableSize($bytes)
    {
        $result = '';
        $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach ($arBytes as $arItem) {
            if ($bytes >= $arItem["VALUE"]) {
                $result = $bytes / $arItem["VALUE"];
                $result = strval(round($result, 2)) . " " . $arItem["UNIT"];
                break;
            }
        }
        return $result;
    }
}

if (!function_exists('activeSubNav')) {
    function activeSubNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' activeSub ' : '';
        }
        return request()->routeIs($route) ? ' activeSub ' : '';
    }
}

if (!function_exists('activeNav')) {
    function activeNav($route)
    {
        if (is_array($route)) {
            $rt = '';
            foreach ($route as $rut) {
                $rt .= request()->routeIs($rut) || '';
            }
            return $rt ? ' active ' : '';
        }
        return request()->routeIs($route) ? ' active ' : '';
    }
}

if (!function_exists('openNav')) {
    function openNav(array $routes)
    {
        $rt = '';
        foreach ($routes as $route) {
            $rt .= request()->routeIs($route) || '';
        }
        return $rt ? ' show ' : '';
    }
}

if (!function_exists('transaction_id')) {
    function transaction_id($src = '', $length = 8)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        if ($src != '') {
            return strtoupper($src.'_'.substr(bin2hex($bytes), 0, $length));
        }
        return strtoupper(substr(bin2hex($bytes), 0, $length));
    }
}

// if (!function_exists('uniqueId')) {
//     function uniqueId($lenght = 8)
//     {
//         if (function_exists("random_bytes")) {
//             $bytes = random_bytes(ceil($lenght / 2));
//         } elseif (function_exists("openssl_random_pseudo_bytes")) {
//             $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
//         } else {
//             throw new \Exception("no cryptographically secure random function available");
//         }
//         return substr(bin2hex($bytes), 0, $lenght);
//     }
// }
if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
    }
}

if (!function_exists('uniqueId')) {
    function uniqueId($lenght = 8)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new \Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}

if (!function_exists('imageStore')) {
    function imageStore(Request $request, string $name, string $path)
    {
        if($request->hasFile('image')){
            $pathCreate = public_path().$path;
            !file_exists($pathCreate) ?? File::makeDirectory($pathCreate, 0777, true, true);

            $image = $request->file('image');
            $image_name = $name . uniqueId(20).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->image->move($path,$image_name);
                return $image_name;
            }
        }
    }
}


if (!function_exists('imageUpdate')) {
    function imageUpdate(Request $request, string $name, string $path, $image)
    {
        if($request->hasFile('image')){
            $deletePath =  public_path($path.$image);
            file_exists($deletePath) ? unlink($deletePath) : false;

            // $deletePath = public_path().$path.$model->first()->image;
            // $path =  public_path('uploads/images/users/'.$files->image);
            // file_exists($deletePath) ? unlink($deletePath) : false;

            $createPath = public_path().$path;
            !file_exists($createPath) ?? File::makeDirectory($createPath, 0777, true, true);

            $image = $request->file('image');
            $image_name = $name . uniqueId(20).'.'.$image->getClientOriginalExtension();
            if ($image->isValid()) {
                $request->image->move($path,$image_name);
                return $image_name;
            }
        }
    }
}

