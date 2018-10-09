<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloGenerico extends Model
{
    public static function scopeGenericoSimple($query, $campo, $valor, $comparador = '=', $operador = '&&', $operador_null = '')
    {
        if($campo !== null)
        {
            if($valor === null)
            {
                if($operador_null == 'not')
                {
                    if($operador == '||')
                    {
                        return $query->orWhereNotNull($campo);
                    }
                    else
                    {
                        return $query->whereNotNull($campo);
                    }
                }
                else
                {
                    if($operador == '||')
                    {
                        return $query->orWhereNull($campo);
                    }
                    else
                    {
                        return $query->whereNull($campo);
                    }
                }
            }
            else if($operador == '||')
            {
                return $query->orWhere($campo, $comparador, $valor);
            }
            else
            {
                return $query->where($campo, $comparador, $valor);
            }
        }
    }

    public static function scopeGenericoConRelacion($query, $relacion, $campo, $valor, $comparador = '=', $operador = '&&', $operador_null = '')
    {
        if($relacion !== null && $campo !== null)
        {
            if($operador == '||')
            {
                return $query->orWhereHas($relacion, function($q) use($campo, $valor, $comparador, $operador_null){
                    $q = self::scopeGenericoSimple($q, $campo, $valor, $comparador, '&&', $operador_null);
                });
            }
            else
            {
                return $query->whereHas($relacion, function($q) use($campo, $valor, $comparador, $operador_null){
                    $q = self::scopeGenericoSimple($q, $campo, $valor, $comparador, '&&', $operador_null);
                });
            }
        }
    }
}
