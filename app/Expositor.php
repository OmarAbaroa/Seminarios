<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expositor extends Model
{
    use SoftDeletes;

    protected $table = 'expositor';
    protected $dates = ['deleted_at'];

    public function escolaridad()
    {
        return $this->belongsTo('App\Escolaridad', 'id_escolaridad');
    }

    public function sexo()
    {
        return $this->belongsTo('App\Sexo', 'id_sexo');
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

    public function scopeExtension($query, $extension, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'extension', $extension, $comparador, $operador, $operador_null);
    }

    public function scopeCorreo($query, $correo, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'correo', $correo, $comparador, $operador, $operador_null);
    }

    public function scopeTelefono($query, $telefono, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'telefono', $telefono, $comparador, $operador, $operador_null);
    }

    public function scopeNombresCompleto($query, $nombre_completo, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre_completo', $nombre_completo, $comparador, $operador, $operador_null);
    }

    public function scopeDeEscolaridad($query, $id_escolaridad, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_escolaridad', $id_escolaridad, $comparador, $operador, $operador_null);
    }

    public function scopeDeSexo($query, $id_sexo, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_sexo', $id_sexo, $comparador, $operador, $operador_null);
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
