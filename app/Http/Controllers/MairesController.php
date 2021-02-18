<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Maires;

class MairesController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code_insee){
        return Maires::where("code_insee",$code_insee)->first();
    }

}
