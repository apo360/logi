<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';

    public function __construct(array $attributes = []){

        parent::__construct($attributes);

        // Obter a lista de colunas da tabela usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);
    }

    public function contrato(){
        return $this->belongsTo(Contrato::class, 'employee_id');
    }

    public function idade(){

        // Convertemos a data de nascimento em um objeto Carbon
        $dataNascimento = Carbon::parse($this->data_nasc);

        // Data atual
        $dataAtual = Carbon::now();

        // Calculamos a diferença de anos entre a data atual e a data de nascimento
        $idade = $dataAtual->diffInYears($dataNascimento);

        // Verificamos se o aniversário já ocorreu este ano
        if ($dataAtual->month < $dataNascimento->month || ($dataAtual->month === $dataNascimento->month && $dataAtual->day < $dataNascimento->day)) {
            $idade--; // Subtrai 1 ano se o aniversário ainda não ocorreu este ano
        }

        return $idade;
    }

}
