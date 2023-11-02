<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ModuloMenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('modulo_menus')->insert([
            ['modulo_id' => 1, 'menu_id' => 2],  // Menu "Clientes" associado ao módulo "Processos"
            ['modulo_id' => 2, 'menu_id' => 2],  // Menu "Clientes" associado ao módulo "Faturação"
            ['modulo_id' => 4, 'menu_id' => 2],  // Menu "Clientes" associado ao módulo "Contabilidade"
        ]);
    }
}

