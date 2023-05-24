<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use  Illuminate\Support\Str;


class ModeleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('modeles')->insert([
        [
            'libelle' => 'Toyota Coaster',
            'code' => '1',
        ],
        [
            'libelle' => 'Mercedes-Benz E-Class',
            'code' => '2',
        ],
        [
            'libelle' => 'Volkswagen Passat',
            'code' => '3',
        ],
        [
            'libelle' => 'BMW 4 Series Convertible',
            'code' => '4',
        ],
        [
            'libelle' => 'Audi A5 Coupe',
            'code' => '5',
        ], ]
        );

    }
    }

