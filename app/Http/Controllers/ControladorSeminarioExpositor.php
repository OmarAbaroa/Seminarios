<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\SeminarioExpositor;

class ControladorSeminarioExpositor extends Controller
{
    public function eliminar($id)
    {
        $seminario_expositor = SeminarioExpositor::find($id);
        
        if($seminario_expositor)
        {
            $seminario_expositor->delete();
            return back()->with('mensaje_exito', 'El expositor fue removido del seminario');
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.eliminar'));
    }

    public function eliminarTodos($id)
    {
        $conflicto = 0;
        $seminario_expositores = SeminarioExpositor::where([
            ['id_seminario', '=', $id],
            ['deleted_at', '=', NULL]
        ])->get();
        
        foreach($seminario_expositores as $seminario_expositor)
        {
            if($seminario_expositor)
            {
                $seminario_expositor->delete();
            }
            else
            {
                $conflicto++;
            }
        }
        if($conflicto == 0)
            return back()->with('mensaje_exito', 'Todos los expositores fueron eliminados.');
        return back()->with('mensaje_error', 'Hubo error al eliminar '.$conflicto.' expositores.');
    }
}
