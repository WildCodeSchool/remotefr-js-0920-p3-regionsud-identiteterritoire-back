<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Communes;
use App\Models\Tourismes;

class FakyController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function evenements(Request $request, $code_insee)
    {
        switch ($code_insee) {
            case '06088': // Nice
                $output = [];
                $output[] = [
                                "title"=>"The Australian Pink Floyd Show",
                                "description"=>"The Australian Pink Floyd Show est le premier groupe dédié à Pink Floyd à être sorti des pubs pour envisager une tournée des stades.",
                                "date"=>"11/02/2021",
                                "addresss"=>"163 route du Mercantour - 06200 NICE",
                                "icon"=>"Mu"
                ];

                $output[] = [
                                "title"=>"Alban Ivanov",
                                "description"=>"Après avoir perturbé la France avec plus de 300 représentations, 3 Olympia, le tout à guichets fermés avec son tout 1er spectacle « Élément Perturbateur », retrouvez Alban Ivanov dans son tout nouveau spectacle.",
                                "date"=>"02/03/2021",
                                "addresss"=>"163 route du Mercantour - 06200 NICE",
                                "icon"=>"Spe"
                ];

                $output[] = [
                                "title"=>"The Dire Straits Experience",
                                "description"=>"Le succès de Dire Straits Experience en France est sans précédent ! Depuis le premier Olympia complet en novembre 2018, plus de 15 000 personnes ont assisté à ce show qui nous replonge dans l’univers des Dire Straits à la note près...",
                                "date"=>"11/03/2021",
                                "addresss"=>"1 Esplanade Kennedy - 06302 NICE CEDEX 4",
                                "icon"=>"Mu"
                ];

                $output[] = [
                                "title"=>"Celtic Legends",
                                "description"=>"Un tout nouveau show 100% live à découvrir en famille et qui conjugue tradition, créativité et modernité !",
                                "date"=>"29/03/2021",
                                "addresss"=>"163 route du Mercantour - 06200 NICE",
                                "icon"=>"Spe"
                ];
                break;

            case '83137': // Toulon
                $output = [];
                $output[] = [
                                "title"=>"11e Festival Présences Féminines",
                                "description"=>"La nuit tombe sur le Musée national de la Marine, Toulon et tire le rideau sur cette dixième édition de festival qui s'achève sur un programme réunissant les oeuvres de Rebecca Clarke.",
                                "date"=>"16/03/2021",
                                "addresss"=>"Divers lieux - 83000 - Toulon",
                                "icon"=>"Fe"
                ];


               $output[] = [
                                "title"=>"Salon Sud Seniors",
                                "description"=>"Au programme : des exposants dans les secteurs de la gastronomie, du confort et de la rénovation de l’habitat, de l'autonomie, maisons de retraite, loisirs, détente et voyages, santé, beauté, droits et patrimoine, services à la personne…",
                                "date"=>"19/03/2021",
                                "addresss"=>"Palais des Congrès Neptune - Place Besagne - Mayol -83000 - Toulon",
                                "icon"=>"Li"
                ];


                $output[] = [
                                "title"=>"6e Salon livres, justice et droit",
                                "description"=>"Salon judiciaire et littéraire sur le thème « L'armée dans tout ses états de droit » pour 2021. Madame Marine Jacquemin, marraine du Salon.",
                                "date"=>"29/03/2021",
                                "addresss"=>"Faculté de droit -35 avenue Alphonse Daudet - 83000 - Toulon",
                                "icon"=>"Li"
                ];


                $output[] = [
                                "title"=>"10e Festival International de Street Painting",
                                "description"=>"Alliance originale entre un public populaire et la création internationale, le Festival International de Street Painting de Toulon offre le plaisir de la découverte, l’envie de donner à voir les démarches artistiques d’ici",
                                "date"=>"12/06/2021",
                                "addresss"=>"Place d'Armes - 83000 - Toulon",
                                "icon"=>"Fe"
                ];



                break;


            case '04088': // Forcalquier
                $output = [];
                break;


            case '83010': // Bargème
                $output = [];
                break;

        }
        return $output;
    }


}




