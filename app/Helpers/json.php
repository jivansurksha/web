<?php

if (!function_exists('countries')) {
    function countries(): array
    {
        try {
            $path = base_path('storage/josn/countries.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('states')) {
    function states(): array
    {
        try {
            $path = base_path('storage/josn/states.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}


if (!function_exists('cities')) {
    function cities(): array
    {
        try {
            $path = base_path('storage/josn/cities.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}

if (!function_exists('specialities')) {
    function specialities(): array
    {
        try {
            $path = base_path('storage/josn/speciality.json');
            $json = file_get_contents($path);
            return json_decode($json, true);
        } catch (Exception $e) {
            return [];
        }
    }
}
