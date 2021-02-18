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
use App\Models\Communes;
class FakerPresentation extends Seeder {

    public function run()
    {

        //php artisan db:seed --class=FakerPresentation
        $toulon = Communes::where("code_insee","83137")->first();
        $toulon->text = "<p>Toulon est une commune du Sud-Est de la France, chef-lieu du département du Var et siège de sa préfecture. Troisième ville de la région Provence-Alpes-Côte d'Azur derrière Marseille et Nice, elle abrite en outre le siège de la préfecture maritime de la Méditerranée. La commune est établie sur les bords de la mer Méditerranée, le long de la rade de Toulon. Ses habitants sont appelés les Toulonnais.
        </p>
        <p>
        La ville de Toulon est située dans le Midi de la France dans le Sud-Ouest du département du Var sur le littoral méditerranéen, à mi-chemin entre Marseille, à l'ouest, et Saint-Tropez, à l'est. On la considère parfois comme la première ville à l'ouest de la Côte d'Azur puisque dans le livre La Côte d'Azur de Stéphen Liégeard, Toulon est incluse comme Marseille dans le premier chapitre consacré à « Hyères et le Pays des Maures ».
        </p>
        <p>
        Avec 176 198 habitants au dernier recensement de 2018, elle est la treizième commune de France par sa population. Toulon est la ville centre d'une unité urbaine de 572 952 habitants, la neuvième de France par sa population. Elle est aussi située au cœur de l'aire urbaine de Toulon, qui regroupe 40 communes, la treizième plus grande aire urbaine de France avec 626 504 habitants en 20162. La ville est enfin le siège d'une métropole, Toulon Provence Méditerranée (TPM), la neuvième de France, qui rassemble douze communes et 433 221 habitants en 20183 soit 43 % de la population du département du Var. Le SCOT Toulon Provence Méditerranée, créé en 2002, regroupe 32 communes. Cuers a rejoint le périmètre du SCOT le 8 septembre 2010. Sa population est évaluée à 572 603 habitants en 2015. </p>
        ";
        $toulon->save();
        $this->command->info('Toulon Successfully!!!!!');



        $nice = Communes::where("code_insee","06088")->first();
        $nice->text = "<p>Nice est une commune du sud-est de la France, préfecture du département des Alpes-Maritimes et deuxième ville de la région Provence-Alpes-Côte d'Azur derrière Marseille. Située à une trentaine de kilomètres de la frontière franco-italienne, elle est établie sur les bords de la mer Méditerranée, le long de la baie des Anges et à l'embouchure du Paillon.</p>
<p>
Selon le recensement de 2018, avec 341 032 habitants, elle est la cinquième commune de France en population (après Paris, Marseille, Lyon et Toulouse). Elle est située au cœur de la sixième agglomération de France avec 942 886 habitants et de la septième aire d'attraction de France, avec environ 600 000 habitants. La ville est le centre d'une métropole, Nice Côte d'Azur, qui rassemble quarante-neuf communes et environ 540 000 habitants3</p>
<p>
Située entre mer et montagne, capitale économique et culturelle de la Côte d'Azur, Nice bénéficie d'importants atouts naturels. Le tourisme, le commerce et les administrations (publiques ou privées) occupent une place importante dans l'activité de la ville. Elle possède la deuxième capacité hôtelière du pays, ce qui lui permet d'accueillir environ 4 millions de touristes chaque année. Elle dispose également du troisième aéroport de France (le premier de province) et de deux palais des congrès consacrés au tourisme d'affaires.</p>
<p>
La ville possède une université, plusieurs quartiers d'affaires, de nombreux musées (il s'agit même de la ville qui en compte le plus en France, après Paris), un théâtre national, un opéra, une bibliothèque à vocation régionale, un conservatoire à rayonnement régional et des salles de concert.</p>

";
        $nice->save();
        $this->command->info('Nice Successfully!!!!!');





        $Forcalquier = Communes::where("code_insee","04088")->first();
        $Forcalquier->text = "<p>Forcalquier (en occitan provençal Forcauquièr selon la graphie classique, Fourcauquié selon la graphie mistralienne) est une commune française située dans le département des Alpes-de-Haute-Provence, en région Provence-Alpes-Côte d'Azur. Jadis capitale d'un comté florissant, fondée au xie siècle, elle est maintenant chef-lieu d’arrondissement. Ses habitants sont appelés les Forcalquiérens.
</p>
<p>
La petite ville a pour devise « Pus aut que leis Aups » (« plus haut que les Alpes »)1 et, pour surnom la « Cité comtale ». Ses monuments principaux sont la cathédrale Notre-Dame du Bourguet (xiiie et xviie siècles), le couvent des Cordeliers (xiiie siècle) et la chapelle Notre-Dame de Provence datant de 1875 et située à l'ancien emplacement de la citadelle d'où la vue domine la Haute-Provence. Forcalquier a la particularité d'avoir « le ciel et l'air les plus purs de France, si ce n'est d'Europe »2. En 2010, avec ses 4 680 habitants, Forcalquier était la sixième ville du département, s'intercalant entre Château-Arnoux-Saint-Auban et Pierrevert, et la 2 198e ville sur le plan national.
</p>
";
        $Forcalquier->save();
        $this->command->info('Forcalquier Successfully!!!!!');




        $Bargeme = Communes::where("code_insee","83010")->first();
        $Bargeme->text = "<p>Bargème fait partie de la communauté de Dracénie Provence Verdon agglomération (ex-Communauté d'Agglomération Dracénoise) de 110 014 habitants en 20175, créée le 31 octobre 2000.
La protection des zones naturelles d’intérêt écologique, faunistique et floristique de la commune témoigne de la qualité de l’environnement:</p>
<p>
Bargème est soumis à un climat méditerranéen d'intérieur. Les hivers sont frais (1 °C de moyenne minimale en février), avec des gelées fréquentes (moyenne de 50 jours de température minimale en dessous de 0 °C), avec une influence du mistral et des vents glaciaux venant des Alpes. Tandis que les étés sont très chauds et secs (30 °C de moyenne maximale en juillet et août), avec souvent des orages. La température moyenne varie entre 5,7 °C en janvier et 22,1 °C en juillet, avec 13,2 °C de température moyenne annuelle.</p>

";
        $Bargeme->save();
        $this->command->info('Bargème Successfully!!!!!');



    }

}

