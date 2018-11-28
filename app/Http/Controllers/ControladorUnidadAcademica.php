<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UnidadAcademica;
use App\Area;

class ControladorUnidadAcademica extends Controller
{
    public function verTodas(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_unidades_academicas' => url()->full()]);
            
            $unidades_academicas = UnidadAcademica::with('area');
            if(preg_match('/\?/', $request->fullUrl()))
            {
                if($request->filtro_nombre)
                {
                    $unidades_academicas->siglas('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                        ->nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE', '||');
                }
                if($request->filtro_clave)
                {
                    $unidades_academicas->clave($request->filtro_clave);
                }
                if($request->filtro_area)
                {
                    $unidades_academicas->deArea($request->filtro_area);
                }
            }
            $unidades_academicas->orderBy('nombre', 'ASC');

            $datos['areas'] = Area::orderBy('nombre', 'ASC')->get();
            $datos['unidades_academicas'] = $unidades_academicas->paginate(env('ELEMENTOS_POR_PAGINA'))
                                                                ->appends($request->except('page'));
                                            
            return view('catalogos.unidades_academicas.unidades_academicas', $datos);
        }
        return redirect()->route('panel');
    }

    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';
            $datos['areas'] = Area::orderBy('nombre', 'ASC')->get();

            return view('catalogos.unidades_academicas.form_unidad_academica', $datos);
        }
        return redirect()->route('panel');
    }

    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::clave($request->clave)->first();
            if(!$unidad_academica)
            {
                $unidad_academica = new UnidadAcademica;
                $unidad_academica->siglas = $request->siglas;
                $unidad_academica->nombre = $request->nombre;
                $unidad_academica->clave = $request->clave;
                $unidad_academica->id_area = $request->area;
                $unidad_academica->rvoe = isset($request->rvoe);
                $unidad_academica->save();

                return redirect()->route('unidades_academicas')->with('mensaje_exito', trans('mensajes.unidades_academicas.exito.almacenar'));
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.error.clave_existe'))->withInput();
        }
        return redirect()->route('panel');
    }

    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::find($id);
            if($unidad_academica)
            {
                $datos['unidad_academica'] = $unidad_academica;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';
                $datos['areas'] = Area::orderBy('nombre', 'ASC')->get();

                return view('catalogos.unidades_academicas.form_unidad_academica', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.error.editar'));
        }
        return redirect()->route('panel');
    }

    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::find($id);
            if($unidad_academica)
            {
                $unidad_academica_clave = UnidadAcademica::clave($request->clave)->id($id, '<>')->first();
                if(!$unidad_academica_clave)
                {
                    $unidad_academica->siglas = $request->siglas;
                    $unidad_academica->nombre = $request->nombre;
                    $unidad_academica->clave = $request->clave;
                    $unidad_academica->id_area = $request->area;
                    $unidad_academica->save();

                    return redirect(session('url_unidades_academicas'))->with('mensaje_exito', trans('mensajes.unidades_academicas.exito.actualizar'));
                }
                return back()->with('mensaje_error', trans('mensajes.unidades_academicas.error.clave_existe'))->withInput();
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }

    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $unidad_academica = UnidadAcademica::find($id);
            if($unidad_academica)
            {
                $unidad_academica->delete();

                return back()->with('mensaje_exito', trans('mensajes.unidades_academicas.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.unidades_academicas.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
