<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
class CulturoController extends Controller
{
    public function index(){

        $client = new Client([
            'base_uri' => config("regionsud.api.culturo.url"),
            'timeout'  => 12.0,
        ]);

//culturo

    if (!Storage::disk('tokens')->exists('culturo')) {
        $response = $client->request('POST', 'login_check', [
                                                        'form_params' => [
                                                                        'username' => config("regionsud.api.culturo.login"),
                                                                        'password' => config("regionsud.api.culturo.password"),
                                                                        ]
                                                    ]);

        if($response->getStatusCode() === 200){
            $res = json_decode($response->getBody()->getContents(),true);
            if(empty($res["token"])){
                return["msg"=>"error"];
            }
            Storage::disk('tokens')->put('culturo', $res["token"]);
        }else {
            return["msg"=>"error"];
        }
    }


/*
{
  "code": 401,
  "message": "Expired JWT Token"
}
*/
    $token_value = Storage::disk('tokens')->get('culturo');
    $response = $client->request('GET', 'evenements', [
        'headers' => [
                        'Authorization' => 'Bearer ' . $token_value,
                        'Accept'        => 'application/json',
                    ],
        'query' => []
    ]);

    dd($response->getBody()->getContents());




        // if($response->getStatusCode() === 200){
        //     return json_decode($response->getBody()->getContents(),true);
        // }else {
        //     return["msg"=>"error"];
        // }
        // dd("index");
    }

    public function show(){
        dd("show");
    }
}
