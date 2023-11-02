<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Contrato extends Model
{
    use HasFactory;

    protected $table = "employee_contract";

    public function __construct(array $attributes = []){

        parent::__construct($attributes);

        // Obter a lista de colunas da tabela usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);
    }

    public static function CreateOrUpdate($data, $funcionario)
    {
        // Verifique se já existe um contrato para o funcionário
        $contrato = self::where('employee_id', $funcionario->Id)->first();

        if ($contrato) {
            // Já existe um contrato, então atualize-o
            $contrato->update($data);
        } else {
            // Não existe um contrato, então crie um novo
            $data['employee_id'] = $funcionario->Id;
            self::create($data);
        }
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'department_id');
    }
}
