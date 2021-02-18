<?php
//
namespace Database\Seeders;
use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Storage;
use App\Models\Tourismes;
use App\Models\TourismesIllustrations;

class PatrimoineCulturelRegionSud extends Seeder {



    public function run()
    {
        //$this->createPatrimoine("commercesservices.json");
        $this->createPatrimoine("activite.json");
        $this->createPatrimoine("equipements.json");
        $this->createPatrimoine("fetesmanifestations.json");
        $this->createPatrimoine("hotellerie.json");
        $this->createPatrimoine("hotelleriepleinair.json");
        $this->createPatrimoine("patrimoineculturel.json");
        $this->createPatrimoine("patrimoinenaturel.json");
        $this->createPatrimoine("restauration.json");
    }


    public function createPatrimoine($file){

                $filename = storage_path('data/raw/tourisme/'.$file);
                $array = json_decode(file_get_contents($filename),true);

                $this->command->info('Patrimoine Culturel - RegionSudData ('.$filename.')');
                $this->command->getOutput()->progressStart(count($array));

                foreach($array as $patrimoine){
                    $t = new Tourismes;
                    $t->code_insee = $patrimoine["localisation"]["adresse"]["commune"]["code"];
                    $t->nom = $patrimoine["nom"]["libelleFr"];
                    $t->type = $patrimoine["type"];

                    if(!empty($patrimoine["informations"]["moyensCommunication"])){
                        foreach($patrimoine["informations"]["moyensCommunication"] as $informations){
                            if(strlen($informations["coordonnees"]["fr"]) < 200){
                                switch ($informations["type"]["libelleFr"]) {
                                    case 'Téléphone':
                                        $t->telephone = $informations["coordonnees"]["fr"];
                                        break;
                                    case 'Mél':
                                        $t->email = $informations["coordonnees"]["fr"];
                                    break;
                                    case 'Site web (URL)':
                                        $t->www = $informations["coordonnees"]["fr"];
                                    break;
                                    case 'Fax':
                                        $t->fax = $informations["coordonnees"]["fr"];
                                    break;
                                }
                            }
                        }
                    }

                    if(!empty($patrimoine["presentation"]["descriptifCourt"]["libelleFr"])){
                         $t->description = $patrimoine["presentation"]["descriptifCourt"]["libelleFr"];
                    }


                    if(!empty($patrimoine["localisation"]["geolocalisation"]["geoJson"])){
                        $t->geolocalisation = json_encode($patrimoine["localisation"]["geolocalisation"]["geoJson"]);
                        $t->longitude = $patrimoine["localisation"]["geolocalisation"]["geoJson"]["coordinates"][0];
                        $t->latitude = $patrimoine["localisation"]["geolocalisation"]["geoJson"]["coordinates"][1];
                    }

                    $t->save();

                    if(!empty($patrimoine["illustrations"])){
                        foreach ($patrimoine["illustrations"] as $illustrations) {
                            $ti = new TourismesIllustrations;
                            $ti->tourisme_id = $t->id;
                            if(!empty($illustrations["nom"]["libelleFr"]) && strlen($illustrations["nom"]["libelleFr"]) < 200){
                                $ti->nom = $illustrations["nom"]["libelleFr"];
                            }

                            if(!empty($illustrations["copyright"]["libelleFr"]) && strlen($illustrations["copyright"]["libelleFr"]) < 200){
                                    $ti->copyright = $illustrations["copyright"]["libelleFr"];
                            }

                            if(!empty($illustrations["traductionFichiers"][0]["urlDiaporama"]) && strlen($illustrations["traductionFichiers"][0]["urlDiaporama"]) < 200){
                                    $ti->urlDiaporama = $illustrations["traductionFichiers"][0]["urlDiaporama"];
                            }

                            if(!empty($illustrations["traductionFichiers"][0]["url"]) && strlen($illustrations["traductionFichiers"][0]["url"]) < 200){
                                    $ti->url = $illustrations["traductionFichiers"][0]["url"];
                            }

                            if(!empty($illustrations["traductionFichiers"][0]["hauteur"])){
                                    $ti->hauteur = $illustrations["traductionFichiers"][0]["hauteur"];
                            }

                            if(!empty($illustrations["traductionFichiers"][0]["largeur"])){
                                    $ti->largeur = $illustrations["traductionFichiers"][0]["largeur"];
                            }

                            if(!empty($illustrations["traductionFichiers"][0]["taille"])){
                                    $ti->taille = $illustrations["traductionFichiers"][0]["taille"];
                            }
                            $ti->type = $t->type;
                            $ti->code_insee = $t->code_insee;
                            $ti->save();
                        }
                    }
                    $this->command->getOutput()->progressAdvance();
                }

            $this->command->getOutput()->progressFinish();
            $this->command->info('Successfully!!!!!');
    }
}

