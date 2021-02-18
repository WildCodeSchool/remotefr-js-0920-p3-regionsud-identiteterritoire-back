<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communes;
use GuzzleHttp\Client;
class MeteoController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code_insee)
    {
        $commune = Communes::where("code_insee",$code_insee)->first();
        if(empty($commune)){
            return [];
        }

        $client = new Client([
            'base_uri' => config("regionsud.api.openweathermap.url"),
            'timeout'  => 2.0,
        ]);

        $response = $client->request('GET', 'weather', [
            'query' => [
                'appid' => config("regionsud.api.openweathermap.api_key"),
                'units' => 'metric',
                'lang'=>'fr',
                'lat' => $commune->latitude,
                'lon' => $commune->longitude
                ]
        ]);

        //https://openweathermap.org/weather-conditions
        //http://openweathermap.org/img/wn/13n@2x.png

        if($response->getStatusCode() === 200){
            return json_decode($response->getBody()->getContents(),true);
        }else {
            return["msg"=>"error"];
        }
    }
}




