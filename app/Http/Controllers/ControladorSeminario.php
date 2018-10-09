<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\UnidadAcademica;
Use App\Seminario;
Use App\TipoSeminario;

class ControladorSeminario extends Controller
{
    public function cargar()
    {
        
        $datos['accion'] = 'Crear';
        $datos['boton'] = 'Crear';
        $datos['unidades_academicas'] = UnidadAcademica::all();
        $datos['tipos_seminarios'] = TipoSeminario::all();
        return view('seminarios.form_crear_seminario', $datos);
        
    }
    public function almacenar(Request $request)
    {
        
        $_seminario = Seminario::where('nombre','=',strtoupper($request->nombre))->get()->first();
        if(!$_seminario)
        {
            $seminario = new Seminario;
            $seminario->nombre = $request->nombre;
            $seminario->registro = NULL;
            $seminario->duracion = $request->duracion;
            $seminario->id_tipo_seminario = $request->tipo_seminario;
            $seminario->id_unidad_academica = $request->unidad_academica;
            
            $seminario->sede = NULL;
            
            if(isset($request->sede))
                $seminario->sede = $request->sede;
            
            if($request->cronograma = "on")
                $seminario->cronograma = 1;
            else
                $seminario->cronograma = 0;

            if($request->programa = "on")
                $seminario->programa = 1;
            else
                $seminario->programa = 0;

            if($request->cv_expositores = "on")
                $seminario->cv_expositores = 1;
            else
                $seminario->cv_expositores = 0;

            if($request->pago = "on")
                $seminario->pago = 1;
            else
                $seminario->pago = 0;

            if($request->rua = "on")
                $seminario->rua = 1;
            else
                $seminario->rua = 0;

            $seminario->impartido = 0;

            $seminario->vigencia_inicio = NULL;
            $seminario->vigencia_fin = NULL;
            $seminario->periodo_inicio = NULL;
            $seminario->periodo_fin = NULL;


            $seminario->save();

            return redirect()->route('seminarios')->with('mensaje_exito', trans('mensajes.seminarios.exito.almacenar'));
        }

        return back()->with('mensaje_error', 'El seminario "'.$_seminario->nombre. '" ya existe.');

    }

    public function verTodos(Request $request)
    {
        $request->flash();
        session(['url_seminarios' => url()->full()]);
            
        if($request->filtro_nombre)
        {
            $seminarios = Seminario::nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                ->orderBy('nombre', 'ASC')
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        else
        {
        $seminarios = Seminario::orderBy('id_unidad_academica', 'ASC')
            ->paginate(env('ELEMENTOS_POR_PAGINA'))
            ->appends($request->except('page'));
        }
        $datos['seminarios'] = $seminarios;
        $datos['unidades_academicas'] = UnidadAcademica::all();
                                            
        return view('seminarios.seminarios', $datos);
    }
        
}
