<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('safe_image_url')) {
    function safe_image_url($path, $defaultDirectory = null) {
        if (!$path) {
            return null;
        }
 
        if (str_contains($path, '/')) {
            $imagePath = $path;
        } else {
            $imagePath = $defaultDirectory ? $defaultDirectory . '/' . $path : $path;
        }

        if (Storage::disk('public')->exists($imagePath)) {
            return Storage::url($imagePath);
        }
        
        return null;
    }
}