<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Funcionario;

Use App\Escolaridad;
Use App\Sexo;

class ControladorFuncionario extends Controller
{
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_funcionarios' => url()->full()]);
            
            if($request->filtro_nombre)
            {
                $funcionarios = Funcionario::nombrescompleto('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                                ->orderBy('nombre_completo', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            else
            {
                $funcionarios = Funcionario::orderBy('nombre_completo', 'ASC')
                                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                ->appends($request->except('page'));
            }
            $datos['funcionarios'] = $funcionarios;
           
                                            
            return view('catalogos.funcionarios.funcionarios', $datos);
        }
        return redirect()->route('panel');
    }
    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';
            $datos['sexos'] = Sexo::all();
            $datos['escolaridades'] = Escolaridad::all();
            return view('catalogos.funcionarios.form_funcionario', $datos);
        }
        return redirect()->route('panel');
    }
    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $funcionario = new Funcionario;
            $funcionario->nombre = strtoupper($request->nombre);
            $funcionario->apellidos = strtoupper($request->apellidos);
            $funcionario->nombre_completo = strtoupper($request->apellidos).' '.strtoupper($request->nombre);
            $funcionario->cargo = strtoupper($request->cargo);
            $funcionario->id_escolaridad = $request->escolaridad;
            $funcionario->id_sexo = $request->sexo;
            
            $funcionario->save();

            return redirect()->route('funcionarios')->with('mensaje_exito', trans('mensajes.funcionarios.exito.almacenar'));
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $funcionario = Funcionario::find($id);
            if($funcionario)
            {
                $datos['sexos'] = Sexo::all();
                $datos['escolaridades'] = Escolaridad::all();
                $datos['funcionario'] = $funcionario;
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('catalogos.funcionarios.form_funcionario', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.funcionarios.error.editar'));
        }
        return redirect()->route('panel');
    }
    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $funcionario = Funcionario::find($id);
            if($funcionario)
            {
                $funcionario->nombre = strtoupper($request->nombre);
                $funcionario->apellidos = strtoupper($request->apellidos);
                $funcionario->nombre_completo = strtoupper($request->apellidos).' '.strtoupper($request->nombre);
                $funcionario->cargo = strtoupper($request->cargo);
                $funcionario->id_escolaridad = $request->escolaridad;
                $funcionario->id_sexo = $request->sexo;
                $funcionario->save();

                return redirect(session('url_funcionarios'))->with('mensaje_exito', trans('mensajes.funcionarios.exito.actualizar'));
            }
            return back()->with('mensaje_error', trans('mensajes.funcionarios.error.actualizar'))->withInput();
        }
        return redirect()->route('panel');
    }
    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $funcionario = Funcionario::find($id);
            if($funcionario)
            {
                $funcionario->delete();

                return back()->with('mensaje_exito', trans('mensajes.funcionarios.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.funcionarios.error.eliminar'));
        }
        return redirect()->route('panel');
    }
}
