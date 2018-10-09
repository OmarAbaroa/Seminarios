<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use App\TipoUsuario;


class ControladorUsuario extends Controller
{
    public function inicio()
    {
        if(\Auth::check())
        {
            return redirect()->route('panel');
        }
        return view('ingreso');
    }
    public function ingresar(Request $request)
    {
        if(\Auth::check())
        {
            return redirect()->route('panel');
        }

        $usuario = $request->usuario;
        $password = $request->password;
        $recordar = $request->recordar;
        if(\Auth::attempt(['nombre' => $usuario, 'password' => $password], $recordar))
        {
            return back();
        }
        return back()->with('mensaje_error', trans('auth.failed'))->withInput();
    }
    public function verPanel()
    {
        $datos['usuario'] = \Auth::user();
        return view('panel', $datos);
    }
    
    public function actualizarUsuario(Request $request)
    {
        $usuario = Usuario::nombre($request->nombre)
                          ->id(\Auth::user()->id, '<>')
                          ->first();
        if(!$usuario)
        {
            \Auth::user()->nombre = $request->nombre;
            \Auth::user()->save();
            return json_encode(
                [
                    'tipo' => env('MENSAJE_EXITO'), 
                    'mensaje' => trans('mensajes.panel.exito.actualizar_nombre'),
                    'nombre' => \Auth::user()->nombre
                ]
            );
        }
        return json_encode(
            [
                'tipo' => env('MENSAJE_ADVERTENCIA'), 
                'mensaje' => trans('mensajes.panel.advertencia.actualizar_nombre')
            ]
        );
    }
    public function actualizarEmail(Request $request)
    {
        $usuario = Usuario::email($request->email)
                          ->id(\Auth::user()->id, '<>')
                          ->first();
        if(!$usuario)
        {
            \Auth::user()->email = $request->email;
            \Auth::user()->save();
            return json_encode(
                [
                    'tipo' => env('MENSAJE_EXITO'), 
                    'mensaje' => trans('mensajes.panel.exito.actualizar_email'),
                    'email' => \Auth::user()->email
                ]
            );
        }
        return json_encode(
            [
                'tipo' => env('MENSAJE_ADVERTENCIA'), 
                'mensaje' => trans('mensajes.panel.advertencia.actualizar_email')
            ]
        );
    }
    public function actualizarContrasena(Request $request)
    {
        $contrasena = $request->password;
        $contrasena_nueva = $request->nueva_password;

        if(\Auth::once(['nombre' => \Auth::user()->nombre, 'password' => $request->password]))
        {
            \Auth::user()->password = \Hash::make($request->nueva_password);
            \Auth::user()->save();
            return json_encode(
                [
                    'tipo' => env('MENSAJE_EXITO'), 
                    'mensaje' => trans('mensajes.panel.exito.actualizar_contrasena')
                ]
            );
        }
        return json_encode(
            [
                'tipo' => env('MENSAJE_ERROR'), 
                'mensaje' => trans('mensajes.panel.error.actualizar_contrasena')
            ]
        );
    }
    public function salir()
    {
        if(\Auth::check())
        {
            \Auth::logout();
        }
    }
    
    public function verTodos(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $request->flash();
            session(['url_usuarios' => url()->full()]);
            
            $datos['tipos'] = TipoUsuario::all();
            $datos['usuarios'] = Usuario::obtenerTodos(\Auth::user(), $request)
                                        ->paginate(env('ELEMENTOS_POR_PAGINA'))
                                        ->appends($request->except('page'));
            return view('usuarios.usuarios', $datos);
        }
        return redirect()->route('panel');
    }

    public function crear()
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $datos['tipos'] = TipoUsuario::all();
            $datos['accion'] = 'Crear';
            $datos['boton'] = 'Crear';

            return view('usuarios.form_usuario', $datos);
        }
        return redirect()->route('panel');
    }

    public function almacenar(Request $request)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $usuario_mismo_nombre = Usuario::nombre($request->usuario)->first();
            $usuario_mismo_email = Usuario::email($request->email)->first();
            if($usuario_mismo_nombre)
            {
                return back()->with('mensaje_error', trans('mensajes.usuarios.error.existe_usuario'))->withInput();
            }
            elseif($usuario_mismo_email)
            {
                return back()->with('mensaje_error', trans('mensajes.usuarios.error.existe_email'))->withInput();
            }
            else
            {
                $usuario = new Usuario;
                $usuario->nombre = $request->usuario;
                $usuario->email = $request->email;
                $usuario->password = \Hash::make($request->password);
                $usuario->id_tipo_usuario = $request->tipo_usuario;
                $usuario->save();

                return redirect()->route('usuarios')->with('mensaje_exito', trans('mensajes.usuarios.exito.almacenar'));
            }
        }
        return redirect()->route('panel');
    }
    public function editar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $usuario = Usuario::find($id);
            if($usuario)
            {
                $datos['usuario'] = $usuario;
                $datos['tipos'] = TipoUsuario::all();
                $datos['accion'] = 'Editar';
                $datos['boton'] = 'Guardar';

                return view('usuarios.form_usuario', $datos);
            }
            return back()->with('mensaje_error', trans('mensajes.usuarios.error.editar'));
        }
        return redirect()->route('panel');
    }
    public function actualizar(Request $request, $id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $usuario = Usuario::find($id);
            if($usuario)
            {
                $usuario_mismo_nombre = Usuario::nombre($request->usuario)->id($usuario->id, '<>')->first();
                $usuario_mismo_email = Usuario::email($request->email)->id($usuario->id, '<>')->first();
                if($usuario_mismo_nombre)
                {
                    return back()->with('mensaje_error', trans('mensajes.usuarios.error.existe_usuario'))->withInput();
                }
                elseif($usuario_mismo_email)
                {
                    return back()->with('mensaje_error', trans('mensajes.usuarios.error.existe_email'))->withInput();
                }
                else
                {
                    $usuario->nombre = $request->usuario;
                    $usuario->email = $request->email;
                    $usuario->id_tipo_usuario = $request->tipo_usuario;
                    $usuario->save();

                    return redirect(session('url_usuarios'))->with('mensaje_exito', trans('mensajes.usuarios.exito.actualizar'));
                }
            }
            return back()->with('mensaje_error', trans('mensajes.usuarios.error.actualizar'));
        }
        return redirect()->route('panel');
    }
    public function eliminar($id)
    {
        if(\Auth::user()->esTipo(env('USUARIO_ADMIN')))
        {
            $usuario = Usuario::find($id);
            if($usuario && $usuario->id != \Auth::user()->id)
            {
                $usuario->delete();

                return back()->with('mensaje_exito', trans('mensajes.usuarios.exito.eliminar'));
            }
            return back()->with('mensaje_error', trans('mensajes.usuarios.error.eliminar'));
        }
        return redirect()->route('panel');
    }

    public function verCatalogos()
    {
        return view('catalogos.catalogos');
    }
}
