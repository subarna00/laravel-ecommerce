<?php

use App\Models\Configuration;
use Illuminate\Support\Facades\File;


// function getConfiguration($key) {
// 	$config = Configuration::where( 'configuration_key', '=', $key )->first();
// 	if ( $config != null ) {
// 		return $config->configuration_value;
// 	}
// 	return null;
// }

if (!function_exists('save_image')) {
    function save_image($image)
    {
        if (file($image)) {
            $name = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('images'), $name);
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

?>
