<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Mairies;

class MairiesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code_insee){
        return Mairies::where("code_insee",$code_insee)->first();
    }

}
