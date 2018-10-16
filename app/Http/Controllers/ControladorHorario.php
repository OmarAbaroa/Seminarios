<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Horario;
Use App\Seminario;

class ControladorHorario extends Controller
{
    public function cargar(Request $request)
    {
        $seminario = Seminario::find($request->id_seminario);
        if($seminario)
        {
            $horario = new Horario;
            $horario->id_seminario = $request->id_seminario;
            $horario->dia = $request->dia;
            $horario->hora_inicio = $request->hora_inicio;
            $horario->hora_final = $request->hora_final;
            $horario->save();
            return json_encode(
                [
                    'tipo' => env('MENSAJE_EXITO'), 
                    'mensaje' => trans('mensajes.horarios.exito.cargar_horario')
                ]
            );
        }
        return json_encode(
            [
                'tipo' => env('MENSAJE_ERROR'), 
                'mensaje' => trans('mensajes.horarios.error.cargar_horario')
            ]
        );
    }
    public function eliminar($id)
    {
        
        $horario = Horario::find($id);
        if($horario)
        {
            $horario->delete();
            return back()->with('mensaje_exito', trans('mensajes.horarios.exito.eliminar'));
        }
        return back()->with('mensaje_error', trans('mensajes.horarios.error.eliminar'));
        
    }
   

}
