<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communes;
use App\Models\Tourismes;
use App\Models\TourismesIllustrations;

class CommunesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = $request->query();

        if(!empty($params["offset"]) && is_int((int)$params["offset"])){
             $offset = $params["offset"];
        }else{
            $offset = 0;
        }

        if(!empty($params["limit"]) && is_int((int)$params["limit"])){
            $limit = $params["limit"];
        }else{
            $limit = 20;
        }
        $output = Communes::offset($offset)->limit($limit)->get();
        return $output;
    }




        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random (Request $request)
    {
        $params = $request->query();

        if(!empty($params["limit"]) && is_int((int)$params["limit"])){
            $limit = $params["limit"];
        }else{
            $limit = 20;
        }
        $output = Communes::inRandomOrder()->limit($limit)->get();
        return $output;
    }



        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $params = $request->query();
        $commune = Communes::limit(10)->select('code_insee', 'nom', 'code_postal');


        if(!empty($params["q"]) AND strlen($params["q"]) >= 3){
            $commune->where("nom","LIKE",$params["q"]."%");
            $commune->orWhere("code_postal","LIKE",$params["q"]."%");
            $output = $commune->get();
            return $output;
        }




        return [];
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete_beta(Request $request)
    {
        $params = $request->query();
        $communes = Communes::select('code_insee', 'nom')->get();
        $output = [];

        foreach ($communes as $commune) {
            $output[] = [
                "label"=>$commune->nom,
                "value"=>$commune->code_insee
            ];
        }
        return $output;





        return [];
    }




    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code_insee)
    {
        return Communes::where("code_insee",$code_insee)->first();
    }





    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery_random(Request $request)
    {

        if(!empty($params["limit"]) && is_int((int)$params["limit"])){
            $limit = $params["limit"];
        }else{
            $limit = 16;
        }


        $tourisme_illustrations = TourismesIllustrations::where("type","PATRIMOINE_CULTUREL")->orWhere('type', 'PATRIMOINE_NATUREL')->where("taille","<","323497")->where("largeur",">","400")->inRandomOrder()->take(150)->get();

        $output = [];
        foreach ($tourisme_illustrations as $tourisme_illustration) {
            $ch = curl_init($tourisme_illustration->urlDiaporama);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($code == 200){       // $retcode >= 400 -> not found, $retcode = 200, found.
                $output[] = $tourisme_illustration;
            }
            curl_close($ch);
            if(count($output) ==$limit){
                return $output;
            }
        }
    return [];
    }




    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery(Request $request, $code_insee)
    {

        if(!empty($params["limit"]) && is_int((int)$params["limit"])){
            $limit = $params["limit"];
        }else{
            $limit = 16;
        }



        $tourisme_illustrations = TourismesIllustrations::where("code_insee",$code_insee)->where("type","PATRIMOINE_CULTUREL")->orWhere('type', 'PATRIMOINE_NATUREL')->where("taille","<","323497")->where("largeur",">","400")->inRandomOrder()->take(150)->get();

        $output = [];
        foreach ($tourisme_illustrations as $tourisme_illustration) {
            $ch = curl_init($tourisme_illustration->urlDiaporama);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($code == 200){       // $retcode >= 400 -> not found, $retcode = 200, found.
                $output[] = $tourisme_illustration;
            }
            curl_close($ch);
            if(count($output) ==$limit){
                return $output;
            }
        }
    return [];
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slider(Request $request, $code_insee)
    {
        $tourisme_illustrations = TourismesIllustrations::where("code_insee",$code_insee)->where("type","PATRIMOINE_CULTUREL")->orWhere('type', 'PATRIMOINE_NATUREL')->where("taille","<","1023497")->orderBy( 'largeur', 'desc' )->take(100)->get();

        foreach ($tourisme_illustrations as $tourisme_illustration) {
            $ch = curl_init($tourisme_illustration->urlDiaporama);
            curl_setopt($ch, CURLOPT_NOBODY, true);
            curl_exec($ch);
            $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if($code == 200){       // $retcode >= 400 -> not found, $retcode = 200, found.
                return $tourisme_illustration;
            }
            curl_close($ch);
        }
    return [];
    }

}
