<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Expositor;
Use App\Seminario;
Use App\SeminarioExpositor;

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
        $seminario = $request->seminario;
        $_seminario = Seminario::Nombre($seminario)->first();
        if(!$_seminario)
        {
            return back()->with('mensaje_error', 'Hubo un error al cargar a los expositores')->withInput();
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
                    $seminario_expositor = new SeminarioExpositor;
                    $seminario_expositor->id_expositor = $_numero_empleado->id;
                    $seminario_expositor->id_seminario = $_seminario->id;
                    $seminario_expositor->save();
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
                    
                    $_numero_empleado = Expositor::NumeroEmpleado($numero_empleado)->first();
                    $seminario_expositor = new SeminarioExpositor;
                    $seminario_expositor->id_expositor = $_numero_empleado->id;
                    $seminario_expositor->id_seminario = $_seminario->id;
                    $seminario_expositor->save();
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
