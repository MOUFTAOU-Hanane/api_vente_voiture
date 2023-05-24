<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use  Illuminate\Support\Str;


class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('types_vehicule')->insert([
            [
                'libelle' =>"BUS",
                'code' => "1",

            ],
            [
                'libelle' =>"BERLINE",
                'code' => "2",

            ],
            [
                'libelle' =>"FAMILIALE",
                'code' => "3",

            ],
            [
                'libelle' =>"CABRIOLET",
                'code' => "4",

            ],
            [
                'libelle' =>"COUPE",
                'code' => "5",

            ],]
        );
        }
    }


