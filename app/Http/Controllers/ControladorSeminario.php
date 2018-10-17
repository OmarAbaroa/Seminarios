<?php

namespace App\Http\Controllers;
Use DB;
Use Illuminate\Http\Request;
Use App\UnidadAcademica;
Use App\Seminario;
Use App\TipoSeminario;
Use App\Funcionario;
Use App\Horario;
Use App\AvisoSeminario;

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
            $seminario->nombre = strtoupper($request->nombre);
            $seminario->duracion = $request->duracion;
            $seminario->id_tipo_seminario = $request->tipo_seminario;
            $seminario->id_unidad_academica = $request->unidad_academica;
            
            $seminario->sede = NULL;
            
            if(isset($request->sede))
                $seminario->sede = $request->sede;
            
            /*if($request->cronograma = "on")
                $seminario->cronograma = 1;
            else
                $seminario->cronograma = 0;
            */

            $seminario->cronograma = isset($request->cronograma);
            $seminario->programa = isset($request->programa);
            $seminario->cv_expositores = isset($request->cv_expositores);
            $seminario->pago = isset($request->pago);
            $seminario->rua = isset($request->rua);
            $seminario->lista_inicial = isset($request->lista_inicial);
            
            $seminario->acta_consejo = isset($request->acta_consejo);
            $seminario->aval_academico = isset($request->aval_academico);
            $seminario->lista_oficial = isset($request->lista_oficial);
            $seminario->relacion_asistencia = isset($request->relacion_asistencia);
            $seminario->evaluacion_final = isset($request->evaluacion_final);
            $seminario->trabajos_finales = isset($request->trabajos_finales);

            $seminario->impartido = 0;

            $seminario->vigencia_inicio = NULL;
            $seminario->vigencia_fin = NULL;
            $seminario->periodo_inicio = NULL;
            $seminario->periodo_fin = NULL;


            $seminario->save();

            return redirect()->route('seminarios')->with('mensaje_exito', trans('mensajes.seminarios.exito.almacenar'));
        }

        return back()->with('mensaje_error', trans('mensajes.seminarios.error.nombre'))->withInput();

    }

    public function verTodos(Request $request)
    {
        $request->flash();
        session(['url_seminarios' => url()->full()]);
            
        if($request->filtro_nombre && $request->filtro_unidad_academica && $request->filtro_registro)
        {
            $seminarios = Seminario::where([['nombre', 'like', '%'.strtoupper($request->filtro_nombre).'%'],['registro', 'like', '%'.strtoupper($request->filtro_registro).'%'],['id_unidad_academica', '=', $request->filtro_unidad_academica]])
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_nombre && $request->filtro_unidad_academica)
        {
            $seminarios = Seminario::where([['nombre', 'like', '%'.strtoupper($request->filtro_nombre).'%'],['id_unidad_academica', '=', $request->filtro_unidad_academica]])
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_nombre && $request->filtro_registro)
        {
            $seminarios = Seminario::where([['nombre', 'like', '%'.strtoupper($request->filtro_nombre).'%'],['registro', 'like', '%'.strtoupper($request->filtro_registro).'%']])
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_unidad_academica && $request->filtro_registro)
        {
            $seminarios = Seminario::where([['registro', 'like', '%'.strtoupper($request->filtro_registro).'%'],['id_unidad_academica', '=', $request->filtro_unidad_academica]])
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_nombre)
        {
            $seminarios = Seminario::nombre('%'.strtoupper($request->filtro_nombre).'%', 'LIKE')
                ->orderBy('nombre', 'ASC')
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_unidad_academica)
        {
            $seminarios = Seminario::DeUnidadAcademica($request->filtro_unidad_academica)
                ->orderBy('nombre', 'ASC')
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        elseif($request->filtro_registro)
        {
            $seminarios = Seminario::registro('%'.strtoupper($request->filtro_registro).'%', 'LIKE')
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

    public function editar($id, $impartir)
    {
        $seminario = Seminario::find($id);
        if($seminario)
        {
            $datos['unidades_academicas'] = UnidadAcademica::all();
            $datos['tipos_seminarios'] = TipoSeminario::all();
            $datos['seminario'] = $seminario;
            $datos['accion'] = 'Editar';
            $datos['boton'] = 'Guardar';
            $datos['impartir'] = $impartir;

            return view('seminarios.form_editar_seminario', $datos);
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }
    public function actualizar(Request $request, $id)
    {
        
        $seminario = Seminario::find($id);
        if($seminario)
        {

            $_seminario = Seminario::where('nombre','=',strtoupper($request->nombre))
                ->where('id','<>',$id)
                ->get()
                ->first();
            if($_seminario)
            {
                return back()->with('mensaje_error', trans('mensajes.seminarios.error.nombre'))->withInput();
            }
            if(isset($request->registro))
            {
                $_seminario = Seminario::where([['registro','=',strtoupper($request->registro)],['id','<>',$id]])->get()->first();
                if($_seminario)
                {
                    return back()->with('mensaje_error', trans('mensajes.seminarios.error.registro'))->withInput();
                }
                else
                {
                    $seminario->registro = strtoupper($request->registro);
                }
            }
            
            $seminario->nombre = strtoupper($request->nombre);
            
            $seminario->duracion = strtoupper($request->duracion);
            $seminario->id_tipo_seminario = $request->tipo_seminario;
            $seminario->id_unidad_academica = $request->unidad_academica;
            if(isset($request->sede))
                $seminario->sede = $request->sede;
            if($seminario->memorandum == 0)
            {
                $seminario->cronograma = isset($request->cronograma);
                $seminario->programa = isset($request->programa);
                $seminario->cv_expositores = isset($request->cv_expositores);
                $seminario->pago = isset($request->pago);
                $seminario->rua = isset($request->rua);
                $seminario->acta_consejo = isset($request->acta_consejo);
                $seminario->aval_academico = isset($request->aval_academico);
            }
            else{
                $seminario->lista_inicial = isset($request->lista_inicial);
                if($seminario->lista_inicial)
                {
                    $avisos = AvisoSeminario::DeSeminario($seminario->id)->get();
                    foreach($avisos as $aviso)
                    {
                        $aviso->delete();
                    }
                }
                $seminario->lista_oficial = isset($request->lista_oficial);
                $seminario->relacion_asistencia = isset($request->relacion_asistencia);
                $seminario->evaluacion_final = isset($request->evaluacion_final);
                $seminario->trabajos_finales = isset($request->trabajos_finales);
            }
            
            if(isset($request->vigencia_inicio))
            {
                $_fecha = explode('/',$request->vigencia_inicio);
                $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                $seminario->vigencia_fin = date("Y-m-d", strtotime($fecha.' + 2 years - 1 days'));
                $seminario->vigencia_inicio = date("Y-m-d", strtotime($fecha));
            }

            
            $seminario->save(); 
            if($seminario->memorandum == 0)
            {
                return redirect(session('url_seminarios'))->with('mensaje_exito', trans('mensajes.seminarios.exito.actualizar'));
            }
            else
                return redirect(route('impartir_seminario'))->with('mensaje_exito', trans('mensajes.seminarios.exito.actualizar'));
        }
        return back()->with('mensaje_error', trans('mensajes.directores.error.actualizar'))->withInput();
        
    }
    public function eliminar($id)
    {
        $seminario = Seminario::find($id);
        if($seminario)
        {
            $seminario->delete();
            return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.eliminar'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.eliminar'));
    }

    public function verImpartir(Request $request)
    {
        $aux = date("Y-m-d");
        $fecha_limite = date("Y-m-d", strtotime($aux.' - 2 months'));
        if($request->filtro_nombre)
        {
            $seminarios = Seminario::where([['nombre','LIKE', '%'.strtoupper($request->filtro_nombre).'%'],['vigencia_fin','>',$fecha_limite],['registro','<>',NULL],['deleted_at','=',NULL],['memorandum','=',1],['respuesta','=','FAVORABLE']])
                ->orderBy('nombre', 'ASC')
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        else
        {
            $seminarios = Seminario::Where([['vigencia_fin','>',$fecha_limite],['registro','<>',NULL],['deleted_at','=',NULL],['memorandum','=',1],['respuesta','=','FAVORABLE']])
                ->orderBy('id_unidad_academica', 'ASC')
                ->paginate(env('ELEMENTOS_POR_PAGINA'))
                ->appends($request->except('page'));
        }
        $datos['seminarios'] = $seminarios;
        $datos['unidades_academicas'] = UnidadAcademica::all();
                                            
        return view('seminarios.impartir_seminario', $datos);
    }

    public function impartir($id)
    {
        $seminario = Seminario::find($id);
        if($seminario)
        {

            $datos['unidades_academicas'] = UnidadAcademica::all();
            $datos['tipos_seminarios'] = TipoSeminario::all();
            $datos['horarios'] = Horario::DeSeminario($id)->get();
            $datos['seminario'] = $seminario;
            $datos['accion'] = 'Impartir';
            $datos['boton'] = 'Guardar';

            return view('seminarios.form_impartir_seminario', $datos);
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }

    public function impartirSeminario(Request $request, $id)
    {
        $seminario = Seminario::find($id);
        if($seminario)
        {
            
            $seminario->impartido = $request->impartido;
            
            $_fecha = explode('/',$request->periodo_inicio);
            $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
            $seminario->periodo_inicio = date("Y-m-d", strtotime($fecha));
            $_fecha = explode('/',$request->periodo_fin);
            $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
            $seminario->periodo_fin = date("Y-m-d", strtotime($fecha));

            if($seminario->periodo_fin > $seminario->periodo_inicio && $seminario->periodo_fin < date("Y-m-d", strtotime($seminario->vigencia_fin.'+ 2 months')) && $seminario->periodo_inicio < date("Y-m-d", strtotime($seminario->vigencia_fin.'+ 2 months')) && $seminario->periodo_fin > $seminario->vigencia_inicio && $seminario->periodo_inicio > $seminario->vigencia_inicio)
            {
                $seminario->save();
                return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.editar'));
            }  
            return back()->with('mensaje_error', 'El periodo queda fuera de vigencia.');
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }

    public function generarRespuesta(Request $request, $id){
        $seminario = Seminario::find($id);
        if($seminario)
        {
            if($request->respuesta == 0)
            {
                $seminario->respuesta = "FAVORABLE";
                $seminario->fecha_entrega_lista_inicial = date("Y-m-d", strtotime(date("Y-m-d").' + 26 days'));
                $aviso = New AvisoSeminario;
                $aviso->fecha_entrega_lista_inicial = $seminario->fecha_entrega_lista_inicial;
                $aviso->id_seminario = $seminario->id;
                $aviso->estado=0;
                $aviso->save();
            }
            else
            {
                $seminario->respuesta = "DESFAVORABLE";
            }
            $seminario->save();
            return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.editar'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }
    public function entregoListaInicial(Request $request, $id){
        
        $seminario = Seminario::find($id);
        if($seminario)
        {
            $seminario->fecha_entrega_lista_inicial = NULL;
            $seminario->lista_inicial = 1;
            $avisos = AvisoSeminario::DeSeminario($id)->get();
            foreach($avisos as $aviso)
            {
                $aviso->delete();
            }
            
            $seminario->save();
            return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.editar'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }

    public function generarMemorandum($id)
    {
        $seminario = Seminario::find($id);
        if($seminario)
        {
            
            $seminario->memorandum = 1;
            $seminario->save();

            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            $section = $phpWord->addSection(array('marginRight' => 800, 'marginLeft' => 800));
            
            //Dirección del texto
            $texto_centrado = array(
                'alignment' => 'center'
            );
            $texto_derecha = array(
                'alignment' => 'right'
            );
            $texto_izquierda = array(
                'alignment' => 'lefr'
            );
            $texto_justificado = array(
                'alignment' => 'distribute'
            );


            $fuente_cuerpo_tabla = array(
                'name' => 'Candara',
                'size' => 9,
            );
            $fuente_cuerpo_tabla_bold = array(
                'name' => 'Candara',
                'size' => 9,
                'bold' => true
            );
            $fuente_cuerpo_texto = array(
                'name'=>'Soberana Sans',
                'size' => 12,
                'bold' => false,
            );
            $fuente_cuerpo_texto_bold = array(
                'name'=>'Soberana Sans',
                'size' => 12,
                'bold' => true,
            );

            $fuente_cabecera_tabla = array(
                'name'=>'Cambria',
                'size' => 10.5,
            );
            $fuente_cabecera_tabla_bold = array(
                'name'=>'Cambria',
                'size' => 10.5,
                'bold' => TRUE
            );
            $fuente_cabecera_titulo = array(
                'name'=>'Cambria',
                'size' => 18,
            );
            $fuente_cabecera_titulo_bold = array(
                'name'=>'Cambria',
                'size' => 18,
                'bold' => TRUE
            );

            $fuente_fin_texto = array(
                'name' => 'Candara',
                'size' => 11,
            );

            $fuente_fin_texto_bold = array(
                'name' => 'Candara',
                'size' => 11,
                'bold' => true
            );

            
            $cellStyle = array(
                'borderColor' => '000000',
                'borderSize'  => 10,
                'cellMargin'  => 25,
                'valign' => 'center',
            );
            $cellStyleCentrado = array(
                'borderColor' => '000000',
                'borderSize'  => 10,
                'cellMargin'  => 25,
                'valign' => 'center',
                'align' => 'center',
            );
            $sinBordeCentrado = array(
                'valign' => 'center',
                'align' => 'center',
            );
            $cellRowSpan = array('vMerge' => 'restart', 
                'borderColor' => '000000',
                'borderSize'  => 10,
                'cellMargin'  => 25,
                'valign' => 'center',
                'align' => 'center'
            );
            $cellRowContinue = array('vMerge' => 'continue',
                'borderColor' => '000000',
                'borderSize'  => 10,
                'cellMargin'  => 25,
                'valign' => 'center',
                'align' => 'center'
            );
            $cellColSpan = array('gridSpan' => 2,
                'borderColor' => '000000',
                'borderSize'  => 10,
                'cellMargin'  => 25,
                'valign' => 'center',
                'align' => 'center'
            );

            //Encabezado
            $header = $section->addHeader();
            //Imagen del encabezado
            $header->addImage("./img/encabezado_DES.png", array('width' => 220, 'height' => 70, 'alignment' => 'right'));
            //Texto encabezado
            $header->addText("MEMORÁNDUM", $fuente_cabecera_titulo_bold, $texto_centrado);
            $header->addText("", $fuente_cabecera_titulo_bold, $texto_centrado);

            //Tabla de para fecha & referencia
            $table = $header->addTable();
            
            $funcionario = Funcionario::cargo('%OPERACIÓN DE UNIDADES ACADÉMICAS%','LIKE')->get()->first();
            $_funcionario = Funcionario::cargo('%TRAYECTORIAS ESTUDIANTILES%','LIKE')->get()->first();
            
            $row = $table->addRow();
            $row->addCell(800, $sinBordeCentrado)->addText(' Para: ', $fuente_cabecera_tabla);
            $celda = $row->addCell(5200, $cellStyle);
            $textRun = $celda->addTextRun();
            $textRun->addText($funcionario->nombre_completo, $fuente_cabecera_tabla_bold);
            $textRun->addTextBreak();
            $textRun->addText($funcionario->cargo, $fuente_cabecera_tabla);
            $row->addCell(1200, $sinBordeCentrado)->addText(' Fecha: ', $fuente_cabecera_tabla);
            $row->addCell(2800, $cellStyleCentrado)->addText(' México, D. F. a '.date("d/m/Y"), $fuente_cabecera_tabla_bold);
            
            $row = $table->addRow();
            $row->addCell(800, $sinBordeCentrado);
            $row->addCell(5200);
            $row->addCell(800, $sinBordeCentrado);
            $row->addCell(2800);

            $row = $table->addRow();
            $row->addCell(800, $sinBordeCentrado)->addText(' De: ', $fuente_cabecera_tabla);
            $celda = $row->addCell(5200, $cellStyle);
            $textRun = $celda->addTextRun();
            $textRun->addText($_funcionario->nombre_completo, $fuente_cabecera_tabla_bold);
            $textRun->addTextBreak();
            $textRun->addText($_funcionario->cargo, $fuente_cabecera_tabla);
            $row->addCell(1200, $sinBordeCentrado)->addText(' Referencia: ', $fuente_cabecera_tabla);
            $row->addCell(2800, $cellStyleCentrado)->addText(' ', $fuente_cabecera_tabla_bold);
            
            $textRun = $section->addText();
            //Cuerpo documento
            $texto1 = "Le solicito de la manera más atenta realizar el Dictamen Técnico Académico al programa del Seminarios de Actualización con Opción de Titulación ";
            $texto2 = " que se imparte en la ".$seminario->unidadAcademica->siglas.".";
            $textRun = $section->addTextRun();
            $textRun->addText($texto1, $fuente_cuerpo_texto, $texto_justificado);
            $textRun->addText($seminario->nombre, $fuente_cuerpo_texto_bold, $texto_justificado);
            $textRun->addText($texto2, $fuente_cuerpo_texto, $texto_justificado);
            
            $section->addText();
            //cuadro
            $table = $section->addTable();
   
            $row = $table->addRow();
            
            $row->addCell(5200, $cellColSpan)->addText('ELEMENTO DE ANÁLISIS: ', $fuente_cuerpo_tabla_bold, $texto_centrado);
            $row->addCell(5200, $cellStyleCentrado)->addText('OBSERVACIONES: ', $fuente_cuerpo_tabla_bold, $texto_centrado);

            $row = $table->addRow();
            $row->addCell(5200, $cellColSpan)->addText("   Programa Original del Seminario: ", $fuente_cuerpo_tabla);
            $row->addCell(5200, $cellRowSpan)->addText('');

            $row = $table->addRow();
            $row->addCell(2600, $cellStyleCentrado)->addText("   Actual ", $fuente_cuerpo_tabla);
            $row->addCell(2600, $cellStyleCentrado)->addText("   Anterior ", $fuente_cuerpo_tabla);
            $table->addCell(null, $cellRowContinue);

            $row = $table->addRow();
            $row->addCell(5200, $cellColSpan)->addText("   Cronograma de actividades: ", $fuente_cuerpo_tabla);
            $row->addCell(5200, $cellStyleCentrado)->addText('');

            $row = $table->addRow();
            $row->addCell(5200, $cellColSpan)->addText("   Acta de H. Consjoe Técnico Consultivo Escolar", $fuente_cuerpo_tabla);
            $row->addCell(5200, $cellStyleCentrado)->addText('');

            $row = $table->addRow();
            $row->addCell(5200, $cellColSpan)->addText("   Curriculum Expositor(es)", $fuente_cuerpo_tabla);
            $row->addCell(5200, $cellStyleCentrado)->addText("   Se envía Curriculo: ", $fuente_cuerpo_tabla);
            $section->addText();
            $section->addText('Sin otro particular, le envío un cordial saludo.', $fuente_fin_texto);
            $section->addText();
            $section->addText();
            $section->addText('ATENTAMENTE', $fuente_fin_texto_bold, $texto_centrado);
            $section->addText('"LA TÉCNICA AL SERVICIO DE LA PATRIA"', $fuente_fin_texto_bold, $texto_centrado);
            
            //Guardar documento
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('Memorandum.doc');
            return response()->download(public_path('Memorandum.doc'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.eliminar'));
    }
        
}
