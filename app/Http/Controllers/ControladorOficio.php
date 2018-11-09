<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Seminario;
Use App\AvisoSeminario;
Use Response;
Use Redirect;
Use Session;
//Dirección del texto
const meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

const texto_centrado = array('alignment' => 'center', 'spaceAfter' => 0);
const texto_derecha = array('alignment' => 'right', 'spaceAfter' => 0);
const texto_izquierda = array('alignment' => 'left', 'spaceAfter' => 0);
const texto_justificado = array('alignment' => 'distribute', 'spaceAfter' => 0);

const fuente_cuerpo_letra_chica = array('name' => 'Soberana Sans', 'size' => '8', 'bold' => false);
const fuente_cuerpo_tabla = array('name' => 'Candara', 'size' => 9);
const fuente_cuerpo_tabla_bold = array('name' => 'Candara', 'size' => 9, 'bold' => true);
const fuente_cuerpo_texto = array('name'=>'Soberana Sans', 'size' => 12, 'bold' => false);
const fuente_cuerpo_texto_bold = array('name'=>'Soberana Sans', 'size' => 12, 'bold' => true);

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
                
                return generarRespuestaDesfavorable($datos);
            }
            
            
            return back()->with('mensaje_exito', trans('mensajes.seminarios.exito.editar'));
        }
        return back()->with('mensaje_error', trans('mensajes.seminarios.error.editar'));
    }

    function generarRespuestaFavorable($datos)
    {
        $seminario = Seminario::find($datos['seminario']['id']);
        
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection(array('marginRight' => 800, 'marginLeft' => 800));

        
        //Encabezado
        $header = $section->addHeader();
        //Imagen del encabezado
        $header->addImage("./img/ENCABEZADO_COMPLETO.png", array('width' => 505, 'height' => 70, 'alignment' => 'right'));
        //Texto encabezado
        $header->addText("“70 Aniversario de la Escuela Superior de Ingeniería Química e Industrias Extractivas”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“40 Aniversario del CECyT 15 Diódoro Antúnez Echegaray”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“30 Aniversario del Centro de innovación y Desarrollo Tecnológico en Computo”", fuente_cabecera_texto, texto_derecha);
        $header->addText("“25 Aniversario de la Escuela Superior de Cómputo”", fuente_cabecera_texto, texto_derecha);
        
        $section->addText('Oficio: ', fuente_cuerpo_letra_chica, texto_izquierda);

        $section->addText('Ciudad de México, a '.date('j').' de '.meses[date('n')-1].' de '.date('Y'), fuente_cuerpo_letra_chica, texto_derecha);

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('OficioFavorable.docx');
        
        
        Session::flash('download.in.the.next.request', 'OficioFavorable.docx');
        return back();
        //return response()->download(public_path('OficioFavorable.docx'))->deleteFileAfterSend(1);
        //return Response::download(public_path('OficioFavorable.docx')) & Redirect::back();
    }
}
