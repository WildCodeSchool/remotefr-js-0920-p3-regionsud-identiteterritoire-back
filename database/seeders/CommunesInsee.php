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


class CommunesInsee extends Seeder {
    public function run()
    {
        $filename = "comunes_insee.csv";
            //$contents = Storage::disk('raw')->get('file.jpg');
            if (Storage::disk('raw')->exists($filename)) {
                $this->command->info('Commune INSEE (CSV)');
                $nbr_line_csv = count(file(storage_path('data/raw/'.$filename), FILE_SKIP_EMPTY_LINES));
                $this->command->getOutput()->progressStart($nbr_line_csv);
                $row = 0;
                if (($handle = fopen(storage_path('data/raw/'.$filename), "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                                $row++;
                                if($row === 1){
                                    continue;
                                }

                                if(!in_array($data[2],config("regionsud.departement"))){
                                     continue;
                                }

                                $communes = new Communes;
                                $communes->code_insee = $data[0];
                                $communes->nom =  $data[1];
                                $communes->slug = Str::slug($data[1], '-');;
                                $communes->departement = $data[2];
                                $communes->region = $data[3];
                                $communes->epci = $data[4];
                                $communes->nature_epci = $data[5];
                                $communes->arrondissement = $data[6];
                                $communes->canton_ville = $data[7];
                                $communes->save();
                                $this->command->getOutput()->progressAdvance();
                    }
                    $this->command->getOutput()->progressFinish();
                    $this->command->info('Successfully!!!!!');
                    fclose($handle);
                }
            }

    }
}
