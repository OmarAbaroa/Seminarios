<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeminarioAlumno extends Model
{
    Use SoftDeletes;

    protected $table = 'seminario_alumno';
    protected $dates = ['deleted_at'];

    public function Seminario()
    {
        return $this->belongsTo('App\Seminario', 'id_seminario');
    }

    public function Alumno()
    {
        return $this->belongsTo('App\Alumno', 'id_alumno');
    }

    public function scopeCalificacion($query, $calificacion, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'calificacion', $calificacion, $comparador, $operador, $operador_null);
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
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

    public function scopeDeAlumno($query, $id_alumno, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_alumno', $id_alumno, $comparador, $operador, $operador_null);
    }
}
