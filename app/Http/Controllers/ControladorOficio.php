<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Seminario;
Use App\AvisoSeminario;
Use Response;
Use Redirect;
Use Session;
Use App\Director;
Use App\Funcionario;
//Dirección del texto
const meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

const texto_centrado = array('alignment' => 'center', 'spaceAfter' => 0);
const texto_derecha = array('alignment' => 'right', 'spaceAfter' => 0);
const texto_izquierda = array('alignment' => 'left', 'spaceAfter' => 0);
const texto_justificado = array('alignment' => 'lowKashida', 'spaceAfter' => 0);

const fuente_cuerpo_letra_chica = array('name' => 'Soberana Sans', 'size' => '8', 'bold' => false);
const fuente_cuerpo_letra_chica_b = array('name' => 'Soberana Sans', 'size' => '8', 'bold' => true);
const fuente_cuerpo_texto = array('name' => 'Soberana Sans', 'size' => 9, 'bold' => false);
const fuente_cuerpo_texto_b = array('name' => 'Soberana Sans', 'size' => 9, 'bold' => true);
const fuente_cuerpo_texto_fondo = array('name' => 'Soberana Sans', 'size' => 6, 'bold' => false);
const fuente_cuerpo_texto_fondo_b = array('name' => 'Soberana Sans', 'size' => 6, 'bold' => true);

const fuente_cuerpo_constancia = array('name' => 'Soberana Sans', 'size' => '10', 'bold' => false);
const fuente_cuerpo_constancia_b = array('name' => 'Soberana Sans', 'size' => '10', 'bold' => true);

const fuente_cabecera_texto = array('name' => 'Arial Narrow', 'size' => '6.5');
const fuente_cabecera_tabla = array('name'=>'Cambria','size' => 10.5);
const fuente_cabecera_tabla_bold = array('name'=>'Cambria', 'size' => 10.5, 'bold' => TRUE);
const fuente_cabecera_titulo = array('name'=>'Cambria', 'size' => 18);
const fuente_cabecera_titulo_bold = array('name'=>'Cambria', 'size' => 18, 'bold' => TRUE);

const fuente_fin_texto = array('name' => 'Candara', 'size' => 11,);
const fuente_fin_texto_bold = array('name' => 'Candara', 'size' => 11, 'bold' => true);

const cellStyle = array('borderColor' => '000000', 'borderSize'  => 10, 'cellMargin'  => 25, 'valign' => 'center',);
const cellStyleCentrado = array('borderColor' => '000000', 'borderSize'  => 10, 'cellMargin'  => 25, 'valign' => 'center', 'align' => 'center');
const sinBordeCentrado = array('valign' => 'center', 'align' => 'center');
const cellRowSpan = array('vMerge' => 'restart', 'borderColor' => '000000', 'borderSize'  => 10, 'cellMargin'  => 25, 'valign' => 'center', 'align' => 'center');
const cellRowContinue = array('vMerge' => 'continue', 'borderColor' => '000000', 'borderSize'  => 10, 'cellMargin'  => 25, 'valign' => 'center', 'align' => 'center');
const cellColSpan = array('gridSpan' => 2,'borderColor' => '000000', 'borderSize'  => 10, 'cellMargin'  => 25, 'valign' => 'center', 'align' => 'center');

const texto_articulo = 'Con fundamento en el Artículo 44, Fracción VII del Reglamento Orgánico; Artículo 5, Fracción III del Reglamento General de Estudios; Artículo 12 del Reglamento de Titulación Profesional, todos del Instituto Politécnico Nacional y en respuesta a su oficio ';
class ControladorOficio extends Controller
{
    public function generarRespuesta(Request $request, $id){
        $seminario = Seminario::find($id);
        if($seminario)
        {
            $datos['seminario'] = $seminario;
            $datos['respuesta'] = $request->respuesta;
            
            if($request->respuesta == 0)
            {
                $seminario->respuesta = "FAVORABLE";
                $seminario->fecha_entrega_lista_inicial = date("Y-m-d", strtotime(date("Y-m-d").' + 26 days'));
                $seminario->registro = $request->registro;
                $_fecha = explode('/',$request->vigencia_inicio);
                $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                $seminario->vigencia_fin = date("Y-m-d", strtotime($fecha.' + 2 years - 1 days'));
                $seminario->vigencia_inicio = date("Y-m-d", strtotime($fecha));
                $seminario->save();
                $aviso = New AvisoSeminario;
                $aviso->fecha_entrega_lista_inicial = $seminario->fecha_entrega_lista_inicial;
                $aviso->id_seminario = $seminario->id;
                $aviso->estado=0;
                $aviso->save();
                
                ControladorOficio::generarRespuestaFavorable($datos);
                return back();
            }
            else
            {
                $seminario->respuesta = "DESFAVORABLE";
                $seminario->save();
                
                return ControladorOficio::generarRespuestaDesfavorable($datos);
            }
            
            
            return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.editar'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }

    function generarRespuestaFavorable($datos)
    {
        $seminario = Seminario::find($datos['seminario']['id']);
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('marginRight' => 500, 'marginLeft' => 500));
        
        //Encabezado
        
        ControladorOficio::cabeceraOficio($section);


        $section->addText('Oficio número: ---', fuente_cuerpo_letra_chica, texto_izquierda);
        $section->addText('Ciudad de México, a '.date('j').' de '.meses[date('n')-1].' de '.date('Y'), fuente_cuerpo_letra_chica, texto_derecha);
        
        $director = Director::where([['id_unidad_academica','=',$seminario->id_unidad_academica],['deleted_at','=',NULL]])->first();
        $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);
        $section->addText($director->nombre_cargo, fuente_cuerpo_letra_chica_b, texto_izquierda);
        $section->addText($director->cargo.' '.$director->UnidadAcademica->nombre.' ('.$director->UnidadAcademica->siglas.')', fuente_cuerpo_letra_chica_b, texto_izquierda);
        if($seminario->rvoe == 0)
            $section->addText('DEL INSTITUTO POLITÉCNICO NACIONAL', fuente_cuerpo_letra_chica_b, texto_izquierda);
        $section->addText('PRESENTE', fuente_cuerpo_letra_chica_b, texto_izquierda);
        $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);
        
        $texto = texto_articulo.'------ le ';
        $texto .= 'comunico que se le ha autorizado el Seminario con Opción a Titulación:';
        $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);

        $section->addText($seminario->nombre, fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto_b, texto_centrado);

        $tableStyle = array('borderSize' => 10, 'cellMargin' => '100');
        $table = $section->addTable([$tableStyle]);
        
        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Folio de Autorización:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText($seminario->registro, fuente_cuerpo_texto, texto_izquierda);

        $vigencia_inicio = explode('-',$seminario->vigencia_inicio);
        $vigencia_fin = explode('-',$seminario->vigencia_fin);
        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Vigencia:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText('Del '.ltrim($vigencia_inicio[2],0).' de '.meses[$vigencia_inicio[1]-1].' del '.$vigencia_inicio[0].' al '.ltrim($vigencia_fin[2],0).' de '.meses[$vigencia_fin[1]-1].' del '.$vigencia_fin[0], fuente_cuerpo_texto, texto_izquierda);

        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Duración:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText($seminario->duracion.' horas', fuente_cuerpo_texto, texto_izquierda);

        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Sede y lugar:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText($seminario->UnidadAcademica->siglas.' '.$seminario->sede, fuente_cuerpo_texto, texto_izquierda);

        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Periodo:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText('----', fuente_cuerpo_texto, texto_izquierda);

        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Días y horario:', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText('----', fuente_cuerpo_texto, texto_izquierda);

        $table->addRow();
        $cell = $table->addCell(2800);
        $cell->addText('Expositor(es):', fuente_cuerpo_texto, texto_izquierda);
        $cell = $table->addCell(7000);
        $cell->addText('----', fuente_cuerpo_texto_b, texto_izquierda);

        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('Debiendo observar lo siguiente:', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $texto = 'Enviar la lista inicial oficial de participantes, firmada y sellada por el Coordinador del Seminario y Subdirector Académico dentro de los ';
        $texto .= 'primeros diez días hábiles posteriores a la fecha del inicio del seminario.';
        $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
        $texto = 'Dar a conocer a los participantes el número de vigencia correspondiente, para trámites de titulación ante la Dirección de Administración Escolar.';
        $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
        $texto = 'Al concluir el programa del seminario enviar la relación de asistencia, de evaluación final y de trabajos finales, en un plazo no mayor a 20 ';
        $texto .= 'días hábiles, para la emisión de las constancias a los participantes.';
        $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
        $texto = 'Cabe señalar que tanto la información emitida para la autorización de vigencia, como los datos de los participantes utilizados en la emisión ';
        $texto .= 'de constancias, está sustentada en los anexos adjuntos a los Oficios enviados por usted, por lo que solicito verificarla a detalle ';
        $texto .= 'previamente a su trámite.';
        $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
        $texto = 'Sin otro particular, le envío un cordial saludo.';
        $section->addText($texto, fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('ATENTAMENTE', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('“La Técnica al Servicio de la Patria”', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('M. EN C. ROSALÍA MARÍA DEL CONSUELO TORRES BEZAURY ', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('DIRECTORA', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto_fondo, texto_izquierda);
        $section->addText('C.c.p.-', fuente_cuerpo_texto_fondo, texto_izquierda);

        ControladorOficio::pieOficio($section);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('OficioFavorable.docx');
        
        Session::flash('download.in.the.next.request', 'OficioFavorable.docx');
        return back();
    }
    function generarRespuestaDesfavorable($datos)
    {
        $seminario = Seminario::find($datos['seminario']['id']);
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('marginRight' => 500, 'marginLeft' => 500));
        
        //Encabezado
        
        ControladorOficio::cabeceraOficio($section);


        $section->addText('Oficio número: ---', fuente_cuerpo_letra_chica, texto_izquierda);
        $section->addText('Ciudad de México, a '.date('j').' de '.meses[date('n')-1].' de '.date('Y'), fuente_cuerpo_letra_chica, texto_derecha);
        $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);

        if($seminario->rvoe == 0)
        {
            //IPN
            $director = Director::where([['id_unidad_academica','=',$seminario->id_unidad_academica],['deleted_at','=',NULL]])->first();
            $section->addText($director->nombre_cargo, fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText($director->cargo.' '.$director->UnidadAcademica->nombre.' ('.$director->UnidadAcademica->siglas.')', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText('DEL INSTITUTO POLITÉCNICO NACIONAL', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText('PRESENTE', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $texto = texto_articulo.' ------------- y ';
            $texto .= 'después del dictamen técnico académico, le comunico que su solicitud de actualización del Seminario de Actualización con Opción a ';
            $texto .= 'Titulación “'.$seminario->nombre.'” quedará pendiente debido a -------';
            $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
            $section->addText('', fuente_cuerpo_texto, texto_izquierda);
            $section->addText('---------------', fuente_cuerpo_texto, texto_izquierda);
            $section->addText('', fuente_cuerpo_texto, texto_izquierda);
            
        }
        else
        {
            //RVOE
            $funcionario = Funcionario::where([['cargo','like','%COORDINADOR DE RECONOCIMIENTO Y VALIDEZ OFICIAL DE ESTUDIOS%'],['deleted_at','=',NULL]])->first();
            $section->addText(strtoupper($funcionario->Escolaridad->nombre).' '.$funcionario->nombre_completo, fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText($funcionario->cargo, fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText('PRESENTE', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $texto = texto_articulo.' ----------- en el ';
            $texto .= 'cual envía copia del oficio ---------------- de '.$seminario->UnidadAcademica->nombre.', solicitando la revisión de los trabajos finales ';
            $texto .= 'del Seminario con Opción a Titulación: “GESTIÓN DE NEGOCIOS”, le informo lo siguiente:';
            $section->addText($texto, fuente_cuerpo_texto, texto_justificado);
            $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        }

        $section->addText('Sin otro particular, me es grato enviarle un cordial saludo.', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);

        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('ATENTAMENTE', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('“La Técnica al Servicio de la Patria”', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('M. EN C. ROSALÍA MARÍA DEL CONSUELO TORRES BEZAURY ', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('DIRECTORA', fuente_cuerpo_texto_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto_fondo, texto_izquierda);
        $section->addText('C.c.p.-', fuente_cuerpo_texto_fondo, texto_izquierda);

        ControladorOficio::pieOficio($section);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('OficioDESFavorable.docx');
        
        Session::flash('download.in.the.next.request', 'OficioDESFavorable.docx');
        return back();
    }
    public function generarOficioConstancias($id)
    {
        $seminario = Seminario::find($id);

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('marginRight' => 1200, 'marginLeft' => 1200));
        
        //Encabezado
        
        ControladorOficio::cabeceraOficio($section);

        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);
        $section->addText('Oficio número: ---', fuente_cuerpo_constancia, texto_izquierda);
        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);
        $section->addText('Ciudad de México, a '.date('j').' de '.meses[date('n')-1].' de '.date('Y'), fuente_cuerpo_constancia_b, texto_derecha);
        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);

        if($seminario->rvoe == 0)
        {
            //IPN
            $director = Director::where([['id_unidad_academica','=',$seminario->id_unidad_academica],['deleted_at','=',NULL]])->first();
            $section->addText($director->nombre_cargo, fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText($director->cargo.' '.$director->UnidadAcademica->nombre.' ('.$director->UnidadAcademica->siglas.')', fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('DEL INSTITUTO POLITÉCNICO NACIONAL', fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('PRESENTE', fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('', fuente_cuerpo_constancia_b, texto_izquierda);

            $texto = texto_articulo.'--------, le envio -- constancias del Seminario de Titulación, “'.$seminario->nombre.'”, con número de vigencia ';
            $texto .= $seminario->registro.', impartido en la Unidad Académica a su digno cargo del ------------, solicitándole sean entregadas a los interesados.';
            $section->addText($texto, fuente_cuerpo_constancia, texto_justificado);
            $section->addText('', fuente_cuerpo_constancia, texto_izquierda);
        }
        else
        {
            //RVOE
            $funcionario = Funcionario::where([['cargo','like','%SECRETARIO DE ACTAS Y ACUERDOS DE LA COORDINACIÓN DE RVOE-IPN%'],['deleted_at','=',NULL]])->first();
            $section->addText('', fuente_cuerpo_letra_chica_b, texto_izquierda);
            $section->addText(strtoupper($funcionario->Escolaridad->nombre).' '.$funcionario->nombre_completo, fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText($funcionario->cargo, fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('PRESENTE', fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('', fuente_cuerpo_constancia_b, texto_izquierda);
            $section->addText('', fuente_cuerpo_constancia_b, texto_izquierda);

            $texto = texto_articulo.'en el cual envió copia del oficio ----------, de .'.$seminario->UnidadAcademica->nombre.', solicitando la emisión de ';
            $texto .= 'las constancias del Seminario de Titulación , “'.$seminario->nombre.'”, con número de vigencia '.$seminario->registro. ', ';
            $texto .= 'le anexo las mismas solicitándole sean enviada al plantel mencionado y sean entregadas a los interesados.';
            $section->addText($texto, fuente_cuerpo_constancia, texto_justificado);
            $section->addText('', fuente_cuerpo_constancia, texto_izquierda);

        }

        $section->addText('Cabe mencionar que la información contenida en las constancias está sustentada en los anexos adjuntos al Oficio anteriormente citado.', fuente_cuerpo_texto, texto_justificado);
        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);
        $section->addText('Sin otro particular, me es grato enviarle un cordial saludo.', fuente_cuerpo_constancia, texto_justificado);
        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);

        $section->addText('', fuente_cuerpo_constancia, texto_izquierda);
        $section->addText('ATENTAMENTE', fuente_cuerpo_constancia_b, texto_centrado);
        $section->addText('“La Técnica al Servicio de la Patria”', fuente_cuerpo_constancia_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('', fuente_cuerpo_texto, texto_izquierda);
        $section->addText('M. EN C. ROSALÍA MARÍA DEL CONSUELO TORRES BEZAURY ', fuente_cuerpo_constancia_b, texto_centrado);
        $section->addText('DIRECTORA', fuente_cuerpo_constancia_b, texto_centrado);
        $section->addText('', fuente_cuerpo_texto_fondo, texto_izquierda);
        $section->addText('C.c.p.-', fuente_cuerpo_texto_fondo, texto_izquierda);

        ControladorOficio::pieOficio($section);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('OficioConstancia.docx');
        
        Session::flash('download.in.the.next.request', 'OficioConstancia.docx');
        
        return redirect()->route('panel');
        
    }
    function cabeceraOficio($section){

        $header = $section->addHeader();
        //Imagen del encabezado
        $header->addImage("./img/ENCABEZADO_COMPLETO.png", array('width' => 505, 'height' => 70, 'alignment' => 'right'));
        //Texto encabezado
        $header->addText("“70 Aniversario de la Escuela Superior de Ingeniería Química e Industrias Extractivas”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“40 Aniversario del CECyT 15 Diódoro Antúnez Echegaray”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“30 Aniversario del Centro de innovación y Desarrollo Tecnológico en Computo”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“25 Aniversario de la Escuela Superior de Cómputo”", fuente_cabecera_texto, texto_derecha);
        
        $header->addWaterMark('./img/fondo.jpg',array( 'marginTop'=> 200, 'marginLeft' => 50,
        'width' => 400,
        'height' => 400, 
        'wrappingStyle' => 'behind',
        'positioning' => 'absolute',
        'posHorizontal'    => 'center',
        'posHorizontalRel' => 'margin',
        'posVertical' => 'bottom',
        'posVerticalRel' => 'bottom-margin-area',));
    }
    function pieOficio($section){
        $footer = $section->addFooter();
        $footer->addText('Unidad Profesional “Adolfo López Mateos”, Col. Zacatenco, Deleg. Gustavo A. Madero, Ciudad de México., C.P. 07738.', fuente_cuerpo_letra_chica,texto_centrado);
        $footer->addText('Conmutador 5729-6000 Extensión 50520, 50430, 50437', fuente_cuerpo_letra_chica,texto_centrado);
        $footer->addText('www.ipn.mx, www.des.ipn.mx', fuente_cuerpo_letra_chica,texto_centrado);
    }
}
