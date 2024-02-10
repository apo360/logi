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
        DB::table('modules')->insert([
            ['module_name' => 'Processos Aduaneiros', 'description' => 'Gerenciamento de processos aduaneiros', 'price' => 15000.00],
            ['module_name' => 'Faturação', 'description' => 'Descrição do Módulo de Faturação', 'price' => 20000.00],
            ['module_name' => 'Recursos Humanos', 'description' => 'Descrição do Módulo de Recursos Humanos', 'price' => 30000.00],
            ['module_name' => 'Contabilidade', 'description' => 'Descrição do Módulo de Contabilidade', 'price' => 0.00],
        ]);
    }
}
