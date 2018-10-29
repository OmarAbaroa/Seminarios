<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConstanciasTrimestreUA extends Model
{
    use SoftDeletes;

    protected $table = 'constancias_trimestre_ua';
    protected $dates = ['deleted_at'];

    public function unidadAcademica()
    {
        return $this->belongsTo('App\UnidadAcademica', 'id_unidad_academica');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeTrimestre($query, $trimestre, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'trimestre', $trimestre, $comparador, $operador, $operador_null);
    }

    public function scopeAnio($query, $anio, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'anio', $anio, $comparador, $operador, $operador_null);
    }

    public function scopeNumeroConstancias($query, $numero_constancias, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'numero_constancias', $numero_constancias, $comparador, $operador, $operador_null);
    }

    public function scopeDeUnidadAcademica($query, $id_unidad_academica, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_unidad_academica', $id_unidad_academica, $comparador, $operador, $operador_null);
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
