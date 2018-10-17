<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public static function obtenerTamanoMaximoSubida()
    {
        $max_mb = str_replace('M', '', ini_get('post_max_size'));
        return $max_mb * 1024 * 1024;
    }

    public static function enIntervalo($valor, $intervalos)
    {
        foreach($intervalos as $intervalo)
        {
            if(preg_match('/-/', $intervalo))
            {
                $menor = explode('-', $intervalo)[0];
                $mayor = explode('-', $intervalo)[1];
                if($menor > $mayor)
                {
                    $aux = $menor;
                    $menor = $mayor;
                    $mayor = $aux;
                }
                if($valor >= $menor && $valor <= $mayor)
                {
                    return true;
                }
            }
            elseif($valor == $intervalo)
            {
                return true;
            }
        }
        return false;
    }
}
