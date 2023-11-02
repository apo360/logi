<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Processo extends Model
{
    use HasFactory;

    protected $tableName = 'processos';

    protected $primaryKey = 'ProcessoID';

    protected $fillable = [
        'ProcessoID',
        'NrProcesso',
        'ContaDespacho',
        'ClienteID',
        'RefCliente',
        'Descricao',
        'DataAbertura',
        'Status',
    ];

    protected $dates = [
        'DataAbertura',
        'created_at',
        'updated_at'
    ];

    /**
     * 
     */
    public static function auto_increment()
    {
        $lastProcesso = self::orderBy('ProcessoID', 'desc')->first();

        if ($lastProcesso) {
            // Obtém o último valor do ProcessoID e incrementa 1
            $newProcessoID = $lastProcesso->ProcessoID + 1;
        } else {
            // Caso não haja registros, começa com o valor 1
            $newProcessoID = 1;
        }

        return $newProcessoID;
    }

    public function getID()
    {
        return $this->ProcessoID;
    }

    /**
     * Gera um novo código de processo sequencial a cada ano.
     *
     * @return string
     */
    public static function generateNewProcesso()
    {
        // Implementar a geração do novo código de processo aqui
        return DB::select('CALL ProcessoNewCod()')[0]->codProcesso;
    }

    /**
     * Gerar um novo código de ContaDespacho sequencial a cada ano. OBS: Esse numero é gerado quando a conta é fechada ou imprimida a carta.
     * 
     * @return string
     */
    public static function generateNewContaDespacho()
    {
        // Implementar a geração do novo código de processo aqui
        return DB::select('CALL DespachoNewCod()')[0]->codProcesso;
    }

    /**
     * Obtém o cliente associado a este processo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo(Customer::class, 'ClienteID');
    }

     /**
     * Obtém a data de abertura formatada.
     *
     * @param date $dataAbertura
     * @return string|null
     */
    protected function getDataAberturaAttribute()
    {
        $dataAbertura = $this->attributes['DataAbertura'];

        if ($dataAbertura) {
            return date('d/m/Y', strtotime($dataAbertura));
        }

        return null;
    }

    /**
     * Obtém a contagem total de processos.
     *
     * @return int
     */
    public static function getTotalProcessos()
    {
        return self::count();
    }

    /**
     * Obtém os processos mais recentes.
     *
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getProcessosRecentes($limit = 5)
    {
        return self::orderBy('DataAbertura', 'desc')->limit($limit)->get();
    }

    /**
     * Obtém as mercadorias associadas a este processo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */

    // Definindo relação One-to-Many com o modelo Mercadoria
    public function mercadorias()
    {
        return $this->hasMany(Mercadoria::class, 'ProcessoID');
    }

    // Definindo relação One-to-One com o modelo Cobrado
    public function cobrado()
    {
        return $this->hasOne(Cobrado::class, 'ProcessoID');
    }

    // Definindo relação One-to-One com o modelo Liquidacao
    public function liquidacao()
    {
        return $this->hasOne(Liquidacao::class, 'ProcessoID');
    }

    // Definindo relação One-to-One com o modelo Portuaria
    public function portuaria()
    {
        return $this->hasOne(Portuaria::class, 'ProcessoID');
    }

    // Definindo relação One-to-One com o modelo Equivalencia
    public function equivalencia()
    {
        return $this->hasOne(Equivalencia::class, 'ProcessoID');
    }

    //Definindo relação One-to-One com o modelo DU
    public function du()
    {
        return $this->hasOne(DU::class, 'ProcessoID');
    }

    public function arquivo()
    {
        return $this->hasMany(Arquivo::class, 'ProcessoID');
    }

}

