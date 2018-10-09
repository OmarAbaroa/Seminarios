<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadAcademicaProgramaAcademico;
use App\UnidadAcademica;
use App\ProgramaAcademico;

class ControladorUnidadAcademicaProgramaAcademico extends Controller
{
    public function verTodos(Request $request, $id_unidad_academica)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::find($id_unidad_academica);
            if($unidad_academica)
            {
                $request->flash();
                
                $programas_academicos = $unidad_academica->programas_academicos()
                                                        ->with([
                                                            'unidades_academicas_programas_academicos' => function($q) use($unidad_academica){
                                                                $q->deUnidadAcademica($unidad_academica->id);
                                                            },
                                                        ]);
                if($request->filtro_nombre_pa)
                {
                    $programas_academicos->nombre('%'.strtoupper($request->filtro_nombre_pa).'%', 'LIKE');
                }
                $programas_academicos->orderBy('nombre', 'ASC');

                $datos['unidad_academica'] = $unidad_academica;
                $datos['programas_academicos_select'] = ProgramaAcademico::orderBy('nombre', 'ASC')->get();
                $datos['programas_academicos'] = $programas_academicos->paginate(env('ELEMENTOS_POR_PAGINA'))
                                                                    ->appends($request->except('page'));
                
                return view('catalogos.unidades_academicas.programas_academicos.programas_academicos', $datos);
            }
        }
        return redirect()->route('unidades_academicas');
    }

    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::find($request->unidad_academica);
            $programa_academico = ProgramaAcademico::find($request->programa_academico);
            if($unidad_academica && $programa_academico)
            {
                $unidad_academica_programa_academico = UnidadAcademicaProgramaAcademico::deUnidadAcademica($unidad_academica->id)
                                                                                        ->deProgramaAcademico($programa_academico->id)
                                                                                        ->first();
                if(!$unidad_academica_programa_academico)
                {
                    $unidad_academica_programa_academico = new UnidadAcademicaProgramaAcademico;
                    $unidad_academica_programa_academico->id_unidad_academica = $unidad_academica->id;
                    $unidad_academica_programa_academico->id_programa_academico = $programa_academico->id;
                    $unidad_academica_programa_academico->save();

                    return back()->with('mensaje_exito', trans('mensajes.unidades_academicas.programas_academicos.exito.almacenar'));
                }
                return back()->with('mensaje_error', trans('mensajes.unidades_academicas.programas_academicos.error.existe'))->withInput();
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.programas_academicos.error.almacenar'))->withInput();
        }
        return redirect()->route('unidades_academicas');
    }

    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica_programa_academico = UnidadAcademicaProgramaAcademico::find($id);
            if($unidad_academica_programa_academico)
            {
                $unidad_academica_programa_academico->delete();

                return back()->with('mensaje_exito', trans('mensajes.unidades_academicas.programas_academicos.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.programas_academicos.error.eliminar'));
        }
        return redirect()->route('unidades_academicas');
    }
}
