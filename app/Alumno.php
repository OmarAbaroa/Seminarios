<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumno extends Model
{
    use SoftDeletes;

    protected $table = 'alumno';
    protected $dates = ['deleted_at'];

    public function sexo()
    {
        return $this->belongsTo('App\Sexo', 'id_sexo');
    }

    public function unidadAcademicaProgramaAcademico()
    {
        return $this->belongsTo('App\UnidadAcademicaProgramaAcademico', 'id_ua_pa');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeNombre($query, $nombre, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre', $nombre, $comparador, $operador, $operador_null);
    }

    public function scopeApellidos($query, $apellidos, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'apellidos', $apellidos, $comparador, $operador, $operador_null);
    }

    public function scopeBoleta($query, $boleta, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'boleta', $boleta, $comparador, $operador, $operador_null);
    }

    public function scopeNombresCompleto($query, $nombre_completo, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre_completo', $nombre_completo, $comparador, $operador, $operador_null);
    }

    public function scopeDeSexo($query, $id_sexo, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_sexo', $id_sexo, $comparador, $operador, $operador_null);
    }

    public function scopeCreado($query, $fecha_hora, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'created_at', $fecha_hora, $comparador, $operador, $operador_null);
    }

    public function scopeDeUnidadAcademicaProgramaAcademico($query, $id_ua_pa, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_ua_pa', $id_ua_pa, $comparador, $operador, $operador_null);
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
