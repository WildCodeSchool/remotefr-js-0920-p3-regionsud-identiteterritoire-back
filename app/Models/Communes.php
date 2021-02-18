<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GeoCommunes;
use App\Models\Maires;
use App\Models\Mairies;

class Communes extends Model
{
protected $table = 'communes';

    public function geoCommune(){
        return $this->hasOne(GeoCommunes::class,"code_insee","code_insee");
    }

    public function maires(){
        return $this->hasOne(GeoCommunes::class,"code_insee","code_insee");
    }

    public function mairies(){
        return $this->hasOne(GeoCommunes::class,"code_insee","code_insee");
    }

}
