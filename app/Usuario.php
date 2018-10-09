<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Usuario;

class Usuario extends Authenticatable
{
    use SoftDeletes;

    protected $table = 'usuario';
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tipo()
    {
        return $this->belongsTo('App\TipoUsuario', 'id_tipo_usuario');
    }

    public function scopeId($query, $id, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id', $id, $comparador, $operador, $operador_null);
    }

    public function scopeNombre($query, $nombre, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'nombre', $nombre, $comparador, $operador, $operador_null);
    }

    public function scopeEmail($query, $email, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'email', $email, $comparador, $operador, $operador_null);
    }

    public function scopePassword($query, $password, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'password', $password, $comparador, $operador, $operador_null);
    }

    public function scopeDeTipoUsuario($query, $id_tipo_usuario, $comparador = '=', $operador = '&&' , $operador_null = '')
    {
        return ModeloGenerico::scopeGenericoSimple($query, 'id_tipo_usuario', $id_tipo_usuario, $comparador, $operador, $operador_null);
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

    public function esTipo($tipo)
    {
        return $this->id_tipo_usuario == $tipo;
    }

    public static function obtenerTodos($usuario, $request = null)
    {
        $usuarios = Usuario::with('tipo')->id(\Auth::user()->id, '<>');

        if($request)
        {
            if($request->filtro_usuario)
            {
                $usuarios->nombre('%'.$request->filtro_usuario.'%', 'LIKE');
            }
            if($request->filtro_email)
            {
                $usuarios->email('%'.$request->filtro_email.'%', 'LIKE');
            }
            if($request->filtro_tipo_usuario)
            {
                $usuarios->deTipoUsuario($request->filtro_tipo_usuario);
            }
        }

        return $usuarios;
    }
}
