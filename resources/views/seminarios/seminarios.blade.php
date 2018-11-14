@extends('plantilla')

@section('titulo', 'Seminarios')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Seminarios</h1>
    </div>
    <br/>
    <div class="ui styled fluid accordion">
        <div class="title">
            <i class="search icon"></i>
            Buscar por:
        </div>
        <div class="content">
            <form method="get" class="ui form">
                @include('elementos_html.input_field', [
                    'id' => 'filtro_nombre',
                    'nombre' => 'filtro_nombre',
                    'etiqueta' => 'Nombre',
                    'placeholder' => 'Nombre',
                    'anterior' => old('filtro_nombre')
                ])
                @include('elementos_html.select_field', [
                    'id' => 'filtro_unidad_academica',
                    'nombre' => 'filtro_unidad_academica',
                    'etiqueta' => 'Unidad Academica',
                    'sin_seleccion' => 'Todos',
                    'anterior' => old('filtro_unidad_academica'),
                    'elementos' => $unidades_academicas,
                    'texto_filtro_todos' => 'Todos',
                    'campo_nombre' => 'siglas',
                ])
                @include('elementos_html.input_field', [
                    'id' => 'filtro_registro',
                    'nombre' => 'filtro_registro',
                    'etiqueta' => 'Registro',
                    'placeholder' => 'Registro',
                    'anterior' => old('filtro_registro')
                ])
                <div class="ui divider"></div>
                <div class="ui grid">
                    <div class="row">
                        <div class="right aligned column">
                            @include('elementos_html.button', [
                                'class' => 'primary cargar',
                                'popup' => 'Buscar',
                                'icono' => 'search',
                                'tipo' => 'submit'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red cargar',
                                'popup' => 'Limpiar campos',
                                'icono' => 'erase',
                                'onclick' => 'redireccionar("' . route('seminarios') . '")'
                            ])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    @include('elementos_html.button', [
        'class' => 'red labeled margen-boton-accion',
        'etiqueta' => 'Regresar',
        'icono' => 'arrow left',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('panel') .'")'
    ])
    @include('elementos_html.button', [
        'class' => 'primary labeled margen-boton-accion',
        'etiqueta' => 'Crear Seminario',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('cargar_seminario') .'")'
    ])
    <table class="ui celled striped table">
        <thead>
            <tr>

                <th>
                    Vigencia
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Registro
                </th>
                <th>
                    Unidad Académica
                </th>
                <th>
                    Impartido
                </th>
                <th>
                    Documentos por entregar:
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($seminarios) > 0)
                @foreach($seminarios as $seminario)
                    <tr>
                        <td>
                            <ul>
                            <?php
                                $sin_vigencia = 0;
                                if($seminario->vigencia_fin == NULL)    
                                    echo "<li class='lista0'>Sin registrar.</li>";
                                else
                                {
                                    $date1 = new DateTime($seminario->vigencia_fin);
                                    $date2 = new DateTime(date("Y-m-d"));
                                    $diff = $date1->diff($date2);
                                    
                                    if($diff->days <= 0 || date("Y-m-d") > $seminario->vigencia_fin)
                                    {
                                        //Significa que la vigencia se acabó
                                        echo "<li class='lista3'>Fuera de vigencia</li>"; 
                                        $sin_vigencia = 1;
                                    }
                                    elseif($diff->days > 0 && $diff->days <= env('PELIGRO_VIGENCIA'))
                                    {
                                        //Hay x días de vigencia
                                        echo "<li class='lista4'><b>Restan <i>".$diff->days."</i> días.</b></li>"; 
                                    }
                                    else{
                                        //La vigencia es mayor a x días
                                        echo "<li class='lista2'>Restan <b><i>".$diff->days."</i></b> días.</li>"; 
                                    }
                                }
                            ?>
                            </ul>
                        </td>
                        <td>
                            {{$seminario->nombre}}
                        </td>
                        <td>
                            <ul>
                            <?php
                                if($seminario->registro == NULL)
                                    echo "<li class='lista0'></li>";
                                else{
                                    echo $seminario->registro;
                                }
                            ?>
                            </ul>
                        </td>
                        <td>
                            {{$seminario->unidadAcademica->siglas}}
                        </td>
                        
                        <td>
                            {{$seminario->impartido}} veces
                        </td>
                        <td>
                            <ul>
                                <li class="lista{{$seminario->cronograma}}">Cronograma</li>
                                <li class="lista{{$seminario->programa}}">Programa</li>
                                <li class="lista{{$seminario->cv_expositores}}">CV de expositores</li>
                                <li class="lista{{$seminario->pago}}">Pago</li>
                                <li class="lista{{$seminario->rua}}">RUA</li>
                                <li class="lista{{$seminario->lista_inicial}}">Lista inicial</li>
                                <li class="lista{{$seminario->acta_consejo}}">Acta del consejo</li>
                                <li class="lista{{$seminario->aval_academico}}">Aval académico</li>
                                <li class="lista{{$seminario->lista_oficial}}">Lista Oficial</li>
                                <li class="lista{{$seminario->relacion_asistencia}}">Relación de asistencia</li>
                                <li class="lista{{$seminario->evaluacion_final}}">Evaluación final</li>
                                <li class="lista{{$seminario->trabajos_finales}}">Trabajos finales</li>
                                @if($seminario->cronograma == 1 && $seminario->programa == 1 && $seminario->cv_expositores == 1 && $seminario->pago == 1 && $seminario->rua == 1 && $seminario->lista_inicial == 1 && $seminario->acta_consejo == 1 && $seminario->aval_academico == 1 && $seminario->lista_oficial  == 1 && $seminario->relacion_asistencia == 1 && $seminario->evaluacion_final == 1 && $seminario->trabajos_finales == 1)
                                    <li class="lista5"></li>
                                @endif
                            </ul>

                            
                        
                        <td>
                            
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_seminario', ['id' => $seminario->id, 'impartir' => 0]) . '")'
                            ])
                            @if($seminario->cronograma == 1 && $seminario->programa == 1 && $seminario->cv_expositores == 1 && $seminario->pago == 1 && $seminario->rua == 1 && $seminario->acta_consejo == 1 && $seminario->aval_academico == 1 && $sin_vigencia == 0)
                                @include('elementos_html.button', [
                                    'class' => 'yellow margen-boton-accion',
                                    'icono' => 'envelope outline',
                                    'popup' => 'Generar memorandum',
                                    'onclick' => 'redireccionar("' . route('generar_memorandum', ['id' => $seminario->id]) . '")'
                                ])
                            @endif
                            @if($seminario->memorandum == 1 && $seminario->cronograma == 1 && $seminario->programa == 1 && $seminario->cv_expositores == 1 && $seminario->pago == 1 && $seminario->rua == 1 && $seminario->acta_consejo == 1 && $seminario->aval_academico == 1 && $sin_vigencia == 0)
                                @include('elementos_html.button', [
                                    'class' => 'gray margen-boton-accion',
                                    'icono' => 'file outline',
                                    'popup' => 'Generar respuesta',
                                    'onclick' => 'abrirModal("generar_respuesta_' . $seminario->id . '")'
                                ])
                            @endif
                            @include('elementos_html.button', [
                                'class' => 'black margen-boton-accion',
                                'icono' => 'eraser',
                                'popup' => 'Limpiar seminario',
                                'onclick' => 'redireccionar("' . route('limpiar_seminario', ['id' => $seminario->id]) . '")'
                            ])
                            
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $seminario->id . '")'
                            ])
                            
                            <div id="eliminar_{{$seminario->id}}" class="ui modal">
                                <div class="header">Eliminar seminario</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$seminario->id}}" method="post" action="{{route('eliminar_seminario', ['id' => $seminario->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el seminario <b>{{$seminario->nombre}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $seminario->id . '")'
                                    ])
                                    <div class="ui red cancel button">No</div>
                                </div>
                            </div>

                            <div id="generar_respuesta_{{$seminario->id}}" class="ui modal">
                                <div class="header">Generar respuesta del seminario</div>
                                <div class="content">
                                    <form id="form_generar_respuesta_{{$seminario->id}}" method="post" action="{{route('generar_respuesta', ['id' => $seminario->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('patch')}}
                                        @include('elementos_html.select_field',[
                                            'class' => 'required',
                                            'etiqueta' => 'Respuesta',
                                            'id' => 'respuesta',
                                            'nombre' => 'respuesta',
                                            'elementos' => $respuesta,
                                            'sin_seleccion' => 'Seleccione'
                                        ])
                                        @include('elementos_html.input_field',[
                                            'etiqueta' => 'Registro',
                                            'nombre' => 'registro',
                                            'id' => 'registro',
                                            'placerholder' => 'Registro',
                                            'anterior' => old('registro'),
                                            'actual' => isset($seminario)? $seminario->registro : '',
                                        ])
                                        @if($seminario->vigencia_inicio)
                                            <?php 
                                                $_fecha = explode('-',$seminario->vigencia_inicio);
                                                $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                                            ?>
                                            @include('elementos_html.input_field', [
                                                'id' => 'vigencia_inicio',
                                                'nombre' => 'vigencia_inicio',
                                                'etiqueta' => 'Vigencia de inicio',
                                                'placeholder' => 'Vigencia de inicio',
                                                'actual' => $fecha,
                                                'class' => 'calendario',
                                                
                                            ])
                                        @endif
                                        @if($seminario->vigencia_inicio == NULL)
                                            @include('elementos_html.input_field', [
                                                'id' => 'vigencia_inicio',
                                                'nombre' => 'vigencia_inicio',
                                                'etiqueta' => 'Vigencia de inicio',
                                                'placeholder' => 'Vigencia de inicio',
                                                'actual' => 'NULL',
                                                'class' => 'calendario',
                                                
                                            ])
                                        @endif
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_generar_respuesta_' . $seminario->id . '")'
                                    ])
                                    <div class="ui red cancel button">No</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="ui center aligned">
                        Sin registros
                    </td>
                </tr>
            @endif
        </tbody>
        {{$seminarios->links()}}
    </table>
@endsection