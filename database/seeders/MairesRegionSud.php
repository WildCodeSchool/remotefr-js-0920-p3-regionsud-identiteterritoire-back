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
// source : https://www.data.gouv.fr/fr/datasets/repertoire-national-des-elus-1/
class MairesRegionSud extends Seeder {
    public function run()
    {

        $filename = "9-rne-maires.txt";
        //$contents = Storage::disk('raw')->get('file.jpg');
        if (Storage::disk('raw')->exists($filename)) {
            $this->command->info('Maires INSEE - RegionSudData ('.$filename.')');

            $nbr_line_csv = count(file(storage_path('data/raw/'.$filename), FILE_SKIP_EMPTY_LINES));
            $this->command->getOutput()->progressStart($nbr_line_csv);
            $row = 0;

             if (($handle = fopen(storage_path('data/raw/'.$filename), "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, "\t")) !== FALSE) {
                            $row++;
                            if($row === 1 || $row === 2 ){
                                continue;
                            }

                            list($CodeDep,$LibDep,$INSEE,$LibCommune,$nom,$prenom,$genre,$date_naissance,$Codeprofession,$profession) = $data;

                            if(!in_array($CodeDep,config("regionsud.departement"))){
                                     continue;
                            }

                            $Code_INSEE = $CodeDep.$INSEE;

                            $m = new Maires;
                            $m->code_insee = $Code_INSEE;
                            $m->nom = iconv('windows-1250', 'utf-8', $nom);;
                            $m->prenom = iconv('windows-1250', 'utf-8', $prenom);
                            $m->genre = $genre;
                            $m->profession = iconv('windows-1250', 'utf-8', $profession);

                            $objDateTime = new \DateTime(str_replace("/","-",$date_naissance));
                            $m->date_naissance= $objDateTime->format("Y-m-d");
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

