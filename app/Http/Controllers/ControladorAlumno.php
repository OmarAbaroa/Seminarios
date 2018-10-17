<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Alumno;

class ControladorAlumno extends Controller
{
    const C_NUMERO = 0;
    const C_NOMBRE = 1;
    const C_APELLIDOS = 2;
    const C_BOLETA = 3;

    public function verCargarAlumno()
    {
        session(['url_alumnos' => url()->full()]);
        return view('alumnos.cargar_alumnos');
    }
    public function cargarAlumno(Request $request)
    {
        $archivo = $request->archivo;
        if(filesize($archivo) > \AppServiceProvider::obtenerTamanoMaximoSubida())
        {
            return back()->with('mensaje_error', trans('mensajes.alumnos.error.archivo_tamano'))->withInput();
        }
        $mime = \File::mimeType($archivo);
        if($mime != 'application/vnd.ms-excel' && $mime != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
        {
            return back()->with('mensaje_error', trans('mensajes.alumnos.error.archivo_formato'))->withInput();
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
                $boleta = trim($fila['boleta']);                

                $_boleta = Alumno::Boleta($boleta)->first();
                if($_boleta)
                {   
                    $conflicto_texto .= ' '.$numero;
                }
                else
                {
                    $alumno = new Alumno;
                    $alumno->nombre = $nombre;
                    $alumno->apellidos = $apellidos;
                    $alumno->nombre_completo = $apellidos.' '.$nombre;
                    $alumno->boleta = $boleta;
                    $alumno->save();
                }
            }
        }
        if($conflicto_texto == '')
        {
            return back()->with('mensaje_exito', 'Alumnos cargados con éxito.')->withInput();    
        }
        return back()->with('mensaje_error', 'Los alumnos con número '.$conflicto_texto.' tienen boleta ya existente')->withInput();
        
    }
}
