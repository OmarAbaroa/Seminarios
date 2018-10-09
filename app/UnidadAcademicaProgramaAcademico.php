<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadAcademicaProgramaAcademico extends Model
{
    use SoftDeletes;

    protected $table = 'unidad_aca_programa_aca';
    protected $dates = ['deleted_at'];

    public function unidad_academica()
    {
        return $this->belongsTo('App\UnidadAcademica', 'id_unidad_academica');
    }

    public function programa_academico()
    {
        return $this->belongsTo('App\ProgramaAcademico', 'id_programa_academico');
    }

    public function alumnos(){
        return $this->hasMany('App\AlumnoUnidadAcademicaProgramaAcademico', 'id_ua_pa');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeDeUnidadAcademica($query, $id_unidad_academica, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_unidad_academica', $id_unidad_academica, $comparador, $operador, $operador_null);
    }

    public function scopeDeProgramaAcademico($query, $id_programa_academico, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_programa_academico', $id_programa_academico, $comparador, $operador, $operador_null);
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
