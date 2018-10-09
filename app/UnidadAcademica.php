<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnidadAcademica extends Model
{
    use SoftDeletes;

    protected $table = 'unidad_academica';
    protected $dates = ['deleted_at'];

    public function area()
    {
        return $this->belongsTo('App\Area', 'id_area');
    }

    public function unidades_academicas_programas_academicos()
    {
        return $this->hasMany('App\UnidadAcademicaProgramaAcademico', 'id_unidad_academica');
    }

    public function seminarios()
    {
        return $this->hasMany('App\Seminario', 'id_unidad_academica');
    }

    public function directores()
    {
        return $this->hasMany('App\Director', 'id_unidad_academica');
    }

    public function programas_academicos()
    {
        return $this->belongsToMany('App\ProgramaAcademico', 'unidad_aca_programa_aca', 'id_unidad_academica', 'id_programa_academico')
                    ->whereNull('unidad_aca_programa_aca.deleted_at');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeNombre($query, $nombre, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre', $nombre, $comparador, $operador, $operador_null);
    }

    public function scopeSiglas($query, $siglas, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'siglas', $siglas, $comparador, $operador, $operador_null);
    }
    
    public function scopeClave($query, $clave, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'clave', $clave, $comparador, $operador, $operador_null);
    }

    public function scopeDeArea($query, $id_area, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_area', $id_area, $comparador, $operador, $operador_null);
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
