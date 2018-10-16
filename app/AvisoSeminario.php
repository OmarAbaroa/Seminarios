<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvisoSeminario extends Model
{
    use SoftDeletes;

    protected $table = 'aviso_seminario';
    protected $dates = ['deleted_at'];

    public function seminario()
    {
        return $this->belongsTo('App\Seminario', 'id_seminario');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }
    
    public function scopeEstado($query, $estado, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'estado', $estado, $comparador, $operador, $operador_null);
    }

    public function scopeFechaEntregaListaInicial($query, $fecha_entrega_lista_inicial, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'fecha_entrega_lista_inicial', $fecha_entrega_lista_inicial, $comparador, $operador, $operador_null);
    }

    public function scopeDeSeminario($query, $id_seminario, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_seminario', $id_seminario, $comparador, $operador, $operador_null);
    }

    public function scopeCreado($query, $fecha_hora, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'created_at', $fecha_hora, $comparador, $operador, $operador_null);
    }

    public function scopeActualizado($query, $fecha_hora, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'updated_at', $fecha_hora, $comparador, $operador, $operador_null);
    }

    public function scopeEliminado($query, $fecha_hora, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'deleted_at', $fecha_hora, $comparador, $operador, $operador_null);
    }
}
