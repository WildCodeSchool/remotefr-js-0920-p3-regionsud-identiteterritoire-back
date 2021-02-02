<?php

return [
            "departement" => ["04","05","06","13","83","84"],
            "departement_full" => [
              "04"=>"Alpes-de-Haute-Provence",
              "05"=>"Hautes-Alpes",
              "06"=>"Alpes-Maritimes",
              "13"=>"Bouches-du-Rhône",
              "83"=>"Var",
              "84"=>"Vaucluse",
            ],
            "api"=>[
                "openweathermap"=>[
                    "api_key"=>env('OPENWEATHERMAP_API_KEY'),
                    "url"=>env('OPENWEATHERMAP_URL')
                ],
                "culturo"=>[
                    "login"=>env('CULTURO_LOGIN'),
                    "password"=>env('CULTURO_PASSWORD'),
                    "url"=>env('CULTURO_URL')
                ]
            ]
];


