<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('modulos')->insert([
            ['nome' => 'Processos Aduaneiros', 'sigla' => 'ProcA', 'posicao' => 1, 'activado' => 1],
            ['nome' => 'Faturação', 'sigla' => 'FT', 'posicao' => 2, 'activado' => 0],
            ['nome' => 'Recursos Humanos', 'sigla' => 'RH', 'posicao' => 3, 'activado' => 0],
            ['nome' => 'Contabilidade', 'sigla' => 'C', 'posicao' => 4, 'activado' => 0],
        ]);
    }
}
