<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DU extends Model
{
    use HasFactory;

    protected $table = 'tb_du';

    protected $fillable = [
        'tipo_depachoID',
        'ProcessoID',
        'NrOrdem',
        'NavioAviao',
        'OrigemID',
        'ProcDestino',
        'CMarcaFiscal',
        'BLCPorte',
        'DataEntrada',
    ];

    protected $dates = [
        'DataEntrada',
        'created_at',
        'updated_at'
    ];

    function processo(){
        return $this->belongsTo(Processo::class, 'ProcessoID');
    }

    static function getDUByTipoDepacho($tipoDepachoID)
    {
        return self::where('tipo_depachoID', $tipoDepachoID)->get();
    }

    static function getTipoDespacho($tipo){
        $tipos = DB::table('tipo_despachante')->where('id',$tipo)->first();

        return $tipos->tipo;
    }

    // Para retornar sempre 12 digitos / enviar 12 digitos na base de dados...
    public function setNrOrdemAttribute($value)
    {
        return str_pad($value, 12, '0', STR_PAD_LEFT);
    }


}
