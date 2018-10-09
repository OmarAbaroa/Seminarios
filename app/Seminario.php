<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seminario extends Model
{
    use SoftDeletes;

    protected $table = 'seminario';
    protected $dates = ['deleted_at'];

    public function horarios()
    {
        return $this->hasMany('App\Horario', 'id_seminario');
    }
    public function expositores()
    {
        return $this->hasMany('App\SeminarioExpositor', 'id_seminario');
    }
    public function alumnos()
    {
        return $this->hasMany('App\SeminarioAlumno', 'id_seminario');
    }
    public function unidadAcademica()
    {
        return $this->belongsTo('App\UnidadAcademica', 'id_unidad_academica');
    }
    public function tipoSeminario()
    {
        return $this->belongsTo('App\TipoSeminario', 'id_tipo_seminario');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeNombre($query, $nombre, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre', $nombre, $comparador, $operador, $operador_null);
    }

    public function scopeRegistro($query, $registro, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'registro', $registro, $comparador, $operador, $operador_null);
    }

    public function scopeDuracion($query, $duracion, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'duracion', $duracion, $comparador, $operador, $operador_null);
    }

    public function scopeSede($query, $sede, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'sede', $sede, $comparador, $operador, $operador_null);
    }

    public function scopeCronograma($query, $cronograma, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'cronograma', $cronograma, $comparador, $operador, $operador_null);
    }
    public function scopePrograma($query, $programa, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'programa', $programa, $comparador, $operador, $operador_null);
    }
    public function scopeCVExpositores($query, $cv_expositores, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'cv_expositores', $cv_expositores, $comparador, $operador, $operador_null);
    }
    public function scopePago($query, $pago, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'pago', $pago, $comparador, $operador, $operador_null);
    }
    public function scopeRua($query, $rua, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'rua', $rua, $comparador, $operador, $operador_null);
    }

    public function scopeListaOficial($query, $lista_oficial, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'lista_oficial', $lista_oficial, $comparador, $operador, $operador_null);
    }

    public function scopeRelacionAsistencia($query, $relacion_asistencia, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'relacion_asistencia', $relacion_asistencia, $comparador, $operador, $operador_null);
    }

    public function scopeEvaluacionFinal($query, $evaluacion_final, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'evaluacion_final', $evaluacion_final, $comparador, $operador, $operador_null);
    }

    public function scopeTrabajosFinales($query, $trabajos_finales, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'trabajos_finales', $trabajos_finales, $comparador, $operador, $operador_null);
    }

    public function scopeVigenciaInicio($query, $vigencia_inicio, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'vigencia_inicio', $vigencia_inicio, $comparador, $operador, $operador_null);
    }

    public function scopeVigenciaFin($query, $vigencia_fin, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'vigencia_fin', $vigencia_fin, $comparador, $operador, $operador_null);
    }

    public function scopePeriodoInicio($query, $periodo_inicio, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'periodo_inicio', $periodo_inicio, $comparador, $operador, $operador_null);
    }
    
    public function scopePeriodoFin($query, $periodo_fin, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'periodo_fin', $periodo_fin, $comparador, $operador, $operador_null);
    }

    public function scopeImpartido($query, $impartido, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'impartido', $impartido, $comparador, $operador, $operador_null);
    }

    public function scopeDeUnidadAcademica($query, $id_unidad_academica, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_unidad_academica', $id_unidad_academica, $comparador, $operador, $operador_null);
    }

    public function scopeDeTipoSeminario($query, $id_tipo_seminario, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_tipo_seminario', $id_tipo_seminario, $comparador, $operador, $operador_null);
    }
}
