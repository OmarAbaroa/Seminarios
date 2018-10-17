<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Expositor;

class ControladorExpositor extends Controller
{
    public function verCargarExpositor()
    {
        session(['url_expositores' => url()->full()]);
        return view('expositores.cargar_expositores');
    }
    public function cargarExpositor(Request $request)
    {
        $archivo = $request->archivo;
        if(filesize($archivo) > \AppServiceProvider::obtenerTamanoMaximoSubida())
        {
            return back()->with('mensaje_error', trans('mensajes.expositores.error.archivo_tamano'))->withInput();
        }
        $mime = \File::mimeType($archivo);
        if($mime != 'application/vnd.ms-excel' && $mime != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        {
            return back()->with('mensaje_error', trans('mensajes.expositores.error.archivo_formato'))->withInput();
        }

        $intervalos = explode(',', str_replace(' ', '', $request->intervalo),0);
        $excel = \Excel::selectSheetsByIndex(0)->load($archivo, function($excel) {})->get();
        $conflicto_texto = '';
        foreach($excel as $fila)
        {   
            if(\AppServiceProvider::enIntervalo(trim($fila['numero']), $intervalos))
                {
                $numero = trim($fila['numero']);
                $nombre = strtoupper(trim($fila['nombre']));
                $apellidos = strtoupper(trim($fila['apellidos']));
                $numero_empleado = trim($fila['empleado']);                
                $escolaridad = trim($fila['escolaridad']);
                $extension = trim($fila['extension']);
                $correo = trim($fila['correo']);
                $telefono = trim($fila['telefono']);
                

                $_numero_empleado = Expositor::NumeroEmpleado($numero_empleado)->first();
                if($_numero_empleado)
                {   
                    $conflicto_texto .= ' '.$numero;
                }
                else
                {
                    $expositor = new Expositor;
                    $expositor->nombre = $nombre;
                    $expositor->apellidos = $apellidos;
                    $expositor->nombre_completo = $escolaridad.' '.$apellidos.' '.$nombre;
                    $expositor->numero_empleado = $numero_empleado;
                    $expositor->extension = $extension;
                    $expositor->correo = $correo;
                    $expositor->telefono = $telefono;
                    $expositor->save();
                }
            }
        }
        if($conflicto_texto == '')
        {
            return back()->with('mensaje_exito', 'Expositores cargados con éxito.')->withInput();    
        }
        return back()->with('mensaje_error', 'Los expositores con número '.$conflicto_texto.' tienen número de empleado ya existente')->withInput();
        
    }
}
