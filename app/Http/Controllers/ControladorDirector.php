<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Director;

Use App\UnidadAcademica;


class ControladorDirector extends Controller
{
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_directores' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $directores = Director::nombrecargo('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                ->orderBy('id_unidad_academica', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            elseif($request->filtro_unidad_academica)
            {
                $directores = Director::DeUnidadAcademica($request->filtro_unidad_academica, '=')
                                ->orderBy('id_unidad_academica', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            else
            {
                $directores = Director::orderBy('id_unidad_academica', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            $datos['directores'] = $directores;
            $datos['unidades_academicas'] = UnidadAcademica::all();
                                            
            return view('catalogos.directores.directores', $datos);
        }
        return redirect()->route('panel');
    }
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';
            $datos['unidades_academicas'] = UnidadAcademica::all();
            return view('catalogos.directores.form_director', $datos);
        }
        return redirect()->route('panel');
    }
    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $director = new Director;
            $director->nombre_cargo = strtoupper($request->nombre);
            $director->id_unidad_academica = $request->unidad_academica;
            $director->save();

            return redirect()->route('directores')->with('mensaje_exito', trans('mensajes.directores.exito.almacenar'));
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $director = Director::find($id);
            if($director)
            {
                $datos['unidades_academicas'] = UnidadAcademica::all();
                $datos['director'] = $director;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.directores.form_director', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.directores.error.editar'));
        }
        return redirect()->route('panel');
    }
    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $director = Director::find($id);
            if($director)
            {
                $director->nombre_cargo = strtoupper($request->nombre);
                $director->id_unidad_academica = $request->unidad_academica;
                
                $director->save();

                return redirect(session('url_directores'))->with('mensaje_exito', trans('mensajes.directores.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.directores.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }
    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $director = Director::find($id);
            if($director)
            {
                $director->delete();

                return back()->with('mensaje_exito', trans('mensajes.directores.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.directores.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
