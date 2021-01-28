<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communes;
use App\Models\Tourismes;
use DB;
class TourismesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code_insee)
    {
        $params = $request->query();
        $tourisme = Tourismes::with("illustrations")->has("illustrations")->where("code_insee",$code_insee)->where("type",$params["type"])->whereNotNull("description")->get();
        return $tourisme;
    }

    public function counter(Request $request, $code_insee)
    {
        $params = $request->query();
        $tourismes = Tourismes::select('type', DB::raw('count(TYPE) as total'))->has("illustrations")->where("code_insee",$code_insee)->whereNotNull("description")->groupBy('type')->get();
        foreach ($tourismes as $tourisme) {
            $tourisme->name = str_replace("_", " ", ucfirst(strtolower($tourisme->type)));
        }
        return $tourismes;
    }

    //$user_info = Usermeta::groupBy('browser')->select('browser', DB::raw('count(*) as total'))->get();



}




