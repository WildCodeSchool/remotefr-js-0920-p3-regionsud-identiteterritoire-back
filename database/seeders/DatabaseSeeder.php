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
use App\Models\Maires;
include("MairieRegionSud.php");
include("CommunesInsee.php");
include("CommunesInseeRegionSud.php");
include("MairesRegionSud.php");
include("GeoCommunesRegionSud.php");
include("PatrimoineCulturelRegionSud.php");
include("FakerPresentation.php");
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // php artisan migrate:refresh --seed
        $this->call([
            CommunesInsee::class,
            CommunesInseeRegionSud::class,
            MairieRegionSud::class,
            MairesRegionSud::class,
            GeoCommunesRegionSud::class,
            PatrimoineCulturelRegionSud::class,
            FakerPresentation::class,//Last

        ]);



    }
}






