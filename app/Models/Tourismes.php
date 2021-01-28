<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TourismesIllustrations;
class Tourismes extends Model
{
protected $table = 'tourismes';

public function illustrations()
{
    return $this->hasMany(TourismesIllustrations::class,"tourisme_id","id");
}


public function slider()
{
    return $this->hasOne(TourismesIllustrations::class,"tourisme_id","id");
}


}
