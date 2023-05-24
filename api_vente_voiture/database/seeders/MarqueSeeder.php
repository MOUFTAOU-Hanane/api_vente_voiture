<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use  Illuminate\Support\Str;


class MarqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marques')->insert([
            ['libelle' => "Ac", 'code' => "1"],
            ['libelle' => "Acura", 'code' => "2"],
            ['libelle' => "Alfa Romeo", 'code' => "3"],
            ['libelle' => "Am General", 'code' => "4"],
            ['libelle' => "Aston Martin", 'code' => "5"],
            ['libelle' => "Audi", 'code' => "6"],
            ['libelle' => "Austin-Healey", 'code' => "7"],
            ['libelle' => "Bentley", 'code' => "8"],
            ['libelle' => "BMW", 'code' => "9"],
            ['libelle' => "Ford", 'code' => "10"],
            ['libelle' => "Genesis", 'code' => "11"],
            ['libelle' => "GMC", 'code' => "12"],
            ['libelle' => "Hino", 'code' => "13"],
            ['libelle' => "Honda", 'code' => "14"],
            ['libelle' => "Hummer", 'code' => "15"],
            ['libelle' => "Hyundai", 'code' => "16"],
            ['libelle' => "Infiniti", 'code' => "17"],
            ['libelle' => "International", 'code' => "18"],
            ['libelle' => "Maserati", 'code' => "19"],
            ['libelle' => "Maybach", 'code' => "20"],
            ['libelle' => "Mazda", 'code' => "21"],
            ['libelle' => "McLaren", 'code' => "22"],
            ['libelle' => "Mercedes-AMG", 'code' => "23"],
            ['libelle' => "Mercedes-Benz", 'code' => "24"],
            ['libelle' => "Mercury", 'code' => "25"],
            ['libelle' => "MG", 'code' => "26"],
            ['libelle' => "MINI", 'code' => "27"],
            ['libelle' => "Renault", 'code' => "28"],
            ['libelle' => "Rivian", 'code' => "29"],
            ['libelle' => "Rolls-Royce", 'code' => "30"],
        ]);


    }
    }


