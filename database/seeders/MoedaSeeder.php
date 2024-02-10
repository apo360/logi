<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoedaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moedas = [
            ['codigo' => 'USD', 'nome' => 'Dólar Americano'],
            ['codigo' => 'EUR', 'nome' => 'Euro'],
            // Adicione mais moedas conforme necessário
        ];

        foreach ($moedas as $moeda) {
            DB::table('moedas')->insert($moeda);
        }
    }
}
