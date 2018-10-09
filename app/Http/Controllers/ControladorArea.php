<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class ControladorArea extends Controller
{
    public function verTodas(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_areas' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $areas = Area::nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                ->orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            else
            {
                $areas = Area::orderBy('nombre', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            $datos['areas'] = $areas;
                                            
            return view('catalogos.areas.areas', $datos);
        }
        return redirect()->route('panel');
    }
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';

            return view('catalogos.areas.form_area', $datos);
        }
        return redirect()->route('panel');
    }
    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $area = new Area;
            $area->nombre = $request->nombre;
            $area->save();

            return redirect()->route('areas')->with('mensaje_exito', trans('mensajes.areas.exito.almacenar'));
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $area = Area::find($id);
            if($area)
            {
                $datos['area'] = $area;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.areas.form_area', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.areas.error.editar'));
        }
        return redirect()->route('panel');
    }

    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $area = Area::find($id);
            if($area)
            {
                $area->nombre = $request->nombre;
                $area->save();

                return redirect(session('url_areas'))->with('mensaje_exito', trans('mensajes.areas.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.areas.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }

    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $area = Area::find($id);
            if($area)
            {
                $area->delete();

                return back()->with('mensaje_exito', trans('mensajes.areas.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.areas.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
