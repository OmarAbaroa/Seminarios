<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProgramaAcademico;

class ControladorProgramaAcademico extends Controller
{
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_programas_academicos' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $programas_academicos = ProgramaAcademico::nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                                        ->orderBy('nombre', 'ASC')
                                                        ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                                        ->appends($request->except('page'));
            }
            else
            {
                $programas_academicos = ProgramaAcademico::orderBy('nombre', 'ASC')
                                                        ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                                        ->appends($request->except('page'));
            }
            $datos['programas_academicos'] = $programas_academicos;
                                            
            return view('catalogos.programas_academicos.programas_academicos', $datos);
        }
        return redirect()->route('panel');
    }
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';

            return view('catalogos.programas_academicos.form_programa_academico', $datos);
        }
        return redirect()->route('panel');
    }

    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $programa_academico = new ProgramaAcademico;
            $programa_academico->nombre = $request->nombre;
            $programa_academico->save();

            return redirect()->route('programas_academicos')->with('mensaje_exito', trans('mensajes.programas_academicos.exito.almacenar'));
        }
        return redirect()->route('panel');
    }

    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $programa_academico = ProgramaAcademico::find($id);
            if($programa_academico)
            {
                $datos['programa_academico'] = $programa_academico;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.programas_academicos.form_programa_academico', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.programas_academicos.error.editar'));
        }
        return redirect()->route('panel');
    }

    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $programa_academico = ProgramaAcademico::find($id);
            if($programa_academico)
            {
                $programa_academico->nombre = $request->nombre;
                $programa_academico->save();

                return redirect(session('url_programas_academicos'))->with('mensaje_exito', trans('mensajes.programas_academicos.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.programas_academicos.error.actualizar'));
        }
        return redirect()->route('panel');
    }

    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $programa_academico = ProgramaAcademico::find($id);
            if($programa_academico)
            {
                $programa_academico->delete();

                return back()->with('mensaje_exito', trans('mensajes.programas_academicos.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.programas_academicos.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
