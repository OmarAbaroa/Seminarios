<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SeminarioAlumno;

class ControladorSeminarioAlumno extends Controller
{
    public function eliminar($id)
    {
        $seminario_alumno = SeminarioAlumno::find($id);
        
        if($seminario_alumno)
        {
            $seminario_alumno->delete();
            return back()->with('mensaje_exito', 'El alumno fue removido del seminario');
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.eliminar'));
    }

    public function eliminarTodos($id)
    {
        $conflicto = 0;
        $seminario_alumnos = SeminarioAlumno::where([
            ['id_seminario', '=', $id],
            ['deleted_at', '=', NULL]
        ])->get();
        
        foreach($seminario_alumnos as $seminario_alumno)
        {
            if($seminario_alumno)
            {
                $seminario_alumno->delete();
            }
            else
            {
                $conflicto++;
            }
        }
        if($conflicto == 0)
            return back()->with('mensaje_exito', 'Todos los alumnos fueron eliminados.');
        return back()->with('mensaje_error', 'Hubo error al eliminar '.$conflicto.' alumnos.');
    }
}
