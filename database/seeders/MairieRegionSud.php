<?php

namespace Database\Seeders;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;
use App\Models\Communes;
use App\Models\Mairies;


class MairieRegionSud extends Seeder {
    public function run()
    {

        $filename = "MAIRIES.csv";
        //$contents = Storage::disk('raw')->get('file.jpg');
        if (Storage::disk('raw')->exists($filename)) {
            $this->command->info('Mairie INSEE - RegionSudData (CSV)');

            $nbr_line_csv = count(file(storage_path('data/raw/'.$filename), FILE_SKIP_EMPTY_LINES));
            $this->command->getOutput()->progressStart($nbr_line_csv);
            $row = 0;
            if (($handle = fopen(storage_path('data/raw/'.$filename), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                            $row++;
                            if($row === 1){
                                continue;
                            }

                            list($ID_Ville,$Code_INSEE,$Libelle_Commune,$Organisme,$Adresse_organisme,$Code_ZIP,$Commune,$Telephone,$Email,$Site_Internet,$Code_Region,$Libelle_Region,$Latitude,$Longitude,$Code_ZE2010,$Libelle_Zone,$Population,$Academie,$Code_Departement,$Libelle_Departement,$Libelle_Intercommunalite,$Code_Arrondissement,$Code_Canton) = $data;

                            if(strlen($Code_INSEE) == 4){
                                $Code_INSEE = "0".$Code_INSEE;
                            }

                            if(strlen($Telephone) == 9){
                                $Telephone = "0".$Telephone;
                            }

                            if(strlen($Code_ZIP) == 4){
                                $Code_ZIP = "0".$Code_ZIP;
                            }

                            $c = Communes::where("code_insee",$Code_INSEE)->first();


                            if(empty($c->nom)){
                                $city_name = null;
                            }else{
                                $city_name = $c->nom;
                                $c->population = $Population;
                                $c->save();
                            }
                            $m = new Mairies;
                            $m->code_insee = $Code_INSEE;
                            $m->adresse = $Adresse_organisme;
                            $m->nom = $city_name;
                            $m->telephone = $Telephone;
                            $m->www = $Site_Internet;
                            $m->email = $Email;
                            $m->longitude= $Longitude;
                            $m->latitude = $Latitude;
                            $m->code_postal = $Code_ZIP;
                            $m->save();
                            $this->command->getOutput()->progressAdvance();
                }
                $this->command->getOutput()->progressFinish();
                $this->command->info('Successfully!!!!!');
                fclose($handle);
            }
        }

    }
}

