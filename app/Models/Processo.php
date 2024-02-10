<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Processo extends Model
{
    use HasFactory;


    protected $table = 'Processos'; // Nome da tabela

    protected $id = 'ProcessoID';

    protected $fillable = [
        'ProcessoID',
        'NrProcesso',
        'ContaDespacho',
        'CustomerID',
        'RefCliente',
        'Descricao',
        'DataAbertura',
        'TipoProcesso',
        'Situacao',
        'UserID',
        // Adicione outros campos fillable conforme necessário
    ];

    protected $dates = [
        'DataAbertura',
        'created_at',
        'updated_at'
    ];

    public static function getLastInsertedId()
    {
        $ultimoProcesso = self::latest()->first();

        if ($ultimoProcesso) {
            return $ultimoProcesso->ProcessoID;
        }

        return null;
    }

    // Relacionamento com a tabela Importacao
    public function importacao()
    {
        return $this->hasOne(Importacao::class, 'Fk_processo', 'ProcessoID');
    }

    // Relacionamento com a tabela Exportacao
    public function exportacao()
    {
        return $this->hasOne(Exportacao::class, 'Fk_processo', 'ProcessoID');
    }

    /**
     * 
     */

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
        return $this->belongsTo(Customer::class, 'CustomerID');
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
     * Metodos para obter estatisticas relativamente aos processos.
     *
     * @return int
     */
    // Método para obter o total de processos
    public static function getTotalProcessos()
    {
        return self::count();
    }

    // Método para obter o total de processos por tipo
    public static function getTotalProcessosPorTipo($tipo)
    {
        return self::where('TipoProcesso', $tipo)->count();
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

    // Definindo relação One-to-One com o modelo Portuaria
    public function portuaria()
    {
        return $this->hasOne(TarifaPortuaria::class, 'Fk_processo','ProcessoID');
    }

    // Definindo relação One-to-One com o modelo Equivalencia
    public function dar()
    {
        return $this->hasOne(TarifaDAR::class, 'Fk_processo','ProcessoID');
    }

    //Definindo relação One-to-One com o modelo DU
    public function du()
    {
        return $this->hasOne(TarifaDU::class, 'Fk_processo','ProcessoID');
    }

}

