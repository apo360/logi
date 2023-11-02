<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['parent_id' => null, 'title' => 'Dashboard', 'slug' => 'dashboard', 'ordem' => 1, 'rota' => '/inicio', 'icone' => 'icone-home', 'modulo_id' => 1, 'activo' => 1],
            ['parent_id' => null, 'title' => 'Clientes', 'slug' => 'clientes', 'ordem' => 2, 'rota' => '/clientes', 'icone' => 'icone-cliente', 'modulo_id' => 2, 'activo' => 1],
            ['parent_id' => null, 'title' => 'Faturas', 'slug' => 'faturas', 'ordem' => 1, 'rota' => '/faturas', 'icone' => 'icone-fatura', 'modulo_id' => 2, 'activo' => 1],
            ['parent_id' => null, 'title' => 'Relatórios', 'slug' => 'relatorios', 'ordem' => 3, 'rota' => '/relatorios', 'icone' => 'icone-relatorio', 'modulo_id' => 4, 'activo' => 1],
            ['parent_id' => 2, 'title' => 'Novo Cliente', 'slug' => 'novo-cliente', 'ordem' => 1, 'rota' => '/clientes/novo', 'icone' => 'icone-add', 'modulo_id' => 1, 'activo' => 1],
            ['parent_id' => 2, 'title' => 'Cliente Corrente', 'slug' => 'conta-corrente-cliente', 'ordem' => 1, 'rota' => '/clientes/conta-corrente', 'icone' => 'icone-money', 'modulo_id' => 1, 'activo' => 1],
        ]);
    }
}
