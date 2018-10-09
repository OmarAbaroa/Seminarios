<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    Use SoftDeletes;

    protected $table = 'horario';
    protected $dates = ['deleted_at'];

    public function Seminario()
    {
        return $this->belongsTo('App\Seminario', 'id_seminario');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeDia($query, $dia, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'dia', $dia, $comparador, $operador, $operador_null);
    }

    public function scopeHoraInicio($query, $hora_inicio, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'hora_inicio', $hora_inicio, $comparador, $operador, $operador_null);
    }

    public function scopeHoraFin($query, $hora_fin, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'hora_fin', $hora_fin, $comparador, $operador, $operador_null);
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

    public function scopeDeSeminario($query, $id_seminario, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_seminario', $id_seminario, $comparador, $operador, $operador_null);
    }
}
