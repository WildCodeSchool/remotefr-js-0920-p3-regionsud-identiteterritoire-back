<?php
//
namespace Database\Seeders;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;
use App\Models\Communes;
use App\Models\Mairies;
use App\Models\Maires;
use App\Models\GeoCommunes;

class GeoCommunesRegionSud extends Seeder {



    public function run()
    {
        $paths = [
            "Alpes-de-Haute-Provence",
            "Alpes-Maritimes",
            "Bouches-du-Rhone",
            "Hautes-Alpes",
            "Var",
            "Vaucluse"
        ];

        foreach($paths as $dep){
                $filename = storage_path('data/raw/opendatasoft/'.$dep.'/correspondance-code-insee-code-postal.json');

                $array = json_decode(file_get_contents($filename),true);
                $this->command->info('GeoCommune by opendatasoft - RegionSudData ('.$dep.')');
                $this->command->getOutput()->progressStart(count($array));
                foreach($array as $commune){

                    $gc = new GeoCommunes;
                    $gc->code_insee = $commune["fields"]["insee_com"];
                    $gc->altitude = $commune["fields"]["z_moyen"];
                    $gc->superficie = $commune["fields"]["superficie"];
                    $gc->longitude = $commune["fields"]["geo_point_2d"][0];
                    $gc->latitude = $commune["fields"]["geo_point_2d"][1];
                    $gc->population = ($commune["fields"]["population"]*1000);
                    $gc->geo_shape = json_encode($commune["fields"]["geo_shape"]);
                    $gc->save();
                    $this->command->getOutput()->progressAdvance();
                }
            $this->command->getOutput()->progressFinish();
            $this->command->info('Successfully!!!!!');
        }
    }
}

