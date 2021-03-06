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



    public function radar(Request $request, $code_insee)
    {
        $params = $request->query();

        $type_all = Tourismes::select('type')->groupBy('type')->get();
        $output = [];
        foreach ($type_all as $type) {
            $row = new \stdClass();
            $row->type= $type->type;
            $row->name = str_replace("_", " ", ucfirst(strtolower($type->type)));
            $row->total = Tourismes::has("illustrations")->where("code_insee",$code_insee)->where("type",$type->type)->whereNotNull("description")->groupBy('type')->count();
            $output[] = $row;
        }
        return $output;
    }





    public function radar_all(Request $request)
    {
        $params = $request->query();

        $type_all = Tourismes::select('type')->groupBy('type')->get();
        $output = [];
        foreach ($type_all as $type) {
            $row = new \stdClass();
            $row->type= $type->type;
            $row->name = str_replace("_", " ", ucfirst(strtolower($type->type)));
            $row->total = Tourismes::has("illustrations")->where("type",$type->type)->whereNotNull("description")->groupBy('type')->count();
            $output[] = $row;
        }
        return $output;
    }


    //$user_info = Usermeta::groupBy('browser')->select('browser', DB::raw('count(*) as total'))->get();



}




