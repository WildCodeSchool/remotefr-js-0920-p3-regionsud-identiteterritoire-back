<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communes;
use App\Models\Mairies;
use Faker\Factory as Faker;

class DevController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filename = storage_path('data/raw/tourisme/fetesmanifestations.json');
        $array = json_decode(file_get_contents($filename),true);

        foreach ($array as $value) {
            dd($value);
        }

    //php artisan make:migration create_tourisme_table

    }


}
