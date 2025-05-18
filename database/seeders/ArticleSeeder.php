<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->insert([
            [
                'name' => 'Canon EOS 5D Mark IV',
                'type' => 'caméra',
                'brand' => 'Canon',
                'state' => 'disponible',
                'description' => 'Reflex 30MP Full Frame, parfait pour la vidéo et la photo professionnelle.',
            ],
            [
                'name' => 'Sigma Art 35mm f/1.4',
                'type' => 'objectif',
                'brand' => 'Sigma',
                'state' => 'emprunté',
                'description' => 'Objectif lumineux pour plans larges et portraits, monture Canon.',
            ],
            [
                'name' => 'LED Neewer 660',
                'type' => 'lumière',
                'brand' => 'Neewer',
                'state' => 'disponible',
                'description' => 'Panneau LED pour tournage, température et intensité réglables.',
            ],
            [
                'name' => 'Micro Rode NTG4+',
                'type' => 'micro',
                'brand' => 'Rode',
                'state' => 'disponible',
                'description' => 'Micro canon pour prise de son directe, batterie interne.',
            ],
            [
                'name' => 'Sony A7 III',
                'type' => 'caméra',
                'brand' => 'Sony',
                'state' => 'emprunté',
                'description' => 'Hybride très polyvalent, vidéo 4K, bonne montée en ISO.',
            ],
        ]);
    }
}
