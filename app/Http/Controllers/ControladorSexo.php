<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sexo;

class ControladorSexo extends Controller
{
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_sexos' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $sexos = Sexo::nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                ->orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            else
            {
                $sexos = Sexo::orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            $datos['sexos'] = $sexos;
                                            
            return view('catalogos.sexos.sexos', $datos);
        }
        return redirect()->route('panel');
    }
    
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';

            return view('catalogos.sexos.form_sexo', $datos);
        }
        return redirect()->route('panel');
    }
    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $sexo = new Sexo;
            $sexo->nombre = $request->nombre;
            $sexo->save();

            return redirect()->route('sexos')->with('mensaje_exito', trans('mensajes.sexos.exito.almacenar'));
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $sexo = Sexo::find($id);
            if($sexo)
            {
                $datos['sexo'] = $sexo;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.sexos.form_sexo', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.sexos.error.editar'));
        }
        return redirect()->route('panel');
    }
    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $sexo = Sexo::find($id);
            if($sexo)
            {
                $sexo->nombre = $request->nombre;
                $sexo->save();

                return redirect(session('url_sexos'))->with('mensaje_exito', trans('mensajes.sexos.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.sexos.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }
    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $sexo = Sexo::find($id);
            if($sexo)
            {
                $sexo->delete();

                return back()->with('mensaje_exito', trans('mensajes.sexos.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.sexos.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
