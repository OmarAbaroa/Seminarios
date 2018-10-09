<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\escolaridad;

class ControladorEscolaridad extends Controller
{
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_escolaridades' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $escolaridades = Escolaridad::nombre('%'.strtoupper($request->filtro_nombre.'%'), 'LIKE')
                                ->orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            else
            {
                $escolaridades = Escolaridad::orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            $datos['escolaridades'] = $escolaridades;
                                            
            return view('catalogos.escolaridades.escolaridades', $datos);
        }
        return redirect()->route('panel');
    }
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';

            return view('catalogos.escolaridades.form_escolaridad', $datos);
        }
        return redirect()->route('panel');
    }
    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $escolaridad = new Escolaridad;
            $escolaridad->nombre = $request->nombre;
            $escolaridad->save();

            return redirect()->route('escolaridades')->with('mensaje_exito', trans('mensajes.escolaridades.exito.almacenar'));
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $escolaridad = Escolaridad::find($id);
            if($escolaridad)
            {
                $datos['escolaridad'] = $escolaridad;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.escolaridades.form_escolaridad', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.escolaridades.error.editar'));
        }
        return redirect()->route('panel');
    }
    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $escolaridad = Escolaridad::find($id);
            if($escolaridad)
            {
                $escolaridad->nombre = $request->nombre;
                $escolaridad->save();

                return redirect(session('url_escolaridades'))->with('mensaje_exito', trans('mensajes.escolaridades.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.escolaridades.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }
    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $escolaridad = Escolaridad::find($id);
            if($escolaridad)
            {
                $escolaridad->delete();

                return back()->with('mensaje_exito', trans('mensajes.escolaridades.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.escolaridades.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
