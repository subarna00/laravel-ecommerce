<?php

use App\Models\Configuration;
use Illuminate\Support\Facades\File;


if (!function_exists('save_image')) {
    function save_image($image, $path = "images")
    {
        if (file($image)) {
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path($path), $name);
            return $name;
        }
        return "";
    }
}

if (!function_exists('delete_image')) {
    function delete_image($image)
    {
        if (File::exists(public_path($image))) {
            File::delete(public_path($image));
        }
    }
}

// documents
if (!function_exists('save_document')) {
    function save_document($document)
    {
        if (file($document)) {
            $name = time() . '.' . $document->getClientOriginalName();
            $document->move(public_path('documents'), $name);
            return $name;
        }
        return "asd";
    }
}
if (!function_exists('delete_document')) {
    function delete_document($document)
    {
        if (File::exists(public_path($document))) {
            File::delete(public_path($document));
        }
    }
}

if (!function_exists('active_sidebar')) {
    function active_sidebar($url)
    {
        foreach ($url as $u) {
            if (str_contains(request()->url(), $u)) {
                return "active";
            }
        }
    }
}

if (!function_exists('showImage')) {
    function showImage($image = null)
    {

        if ($image !== null) {
            $img = "images/" . $image;
            if (File::exists(public_path($img))) {
                return asset($img);
            }
        }

        return "/frontend/default/images/default.jpeg";
    }
}
if (!function_exists('getDiscountPrice')) {
    function getDiscountPrice($price, $discount)
    {
        $discountPrice = $price - ($price * ($discount / 100));
        return $discountPrice;
    }
}
