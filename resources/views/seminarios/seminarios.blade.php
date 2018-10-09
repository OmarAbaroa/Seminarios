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
                                if($seminario->vigencia_fin == NULL)    
                                echo "<li class='lista0'></li>";
                                else
                                {
                                    $aux =  explode('-', $seminario->vigencia_fin);
                                    $aux2=(substr($aux[0],0,4).'/'.substr($aux[1],0,2).'/'.substr($aux[2],0,2));

                                    $dteStart = new DateTime($aux2);
                                    $dteEnd   = new DateTime(date("Y-m-d")); 
                                    
                                    $dteDiff  = $dteStart->diff($dteEnd)->d; 
                                    
                                    if($dteDiff < 15)
                                        echo "<li class='lista3'>Restan ".$dteDiff." días</li>";
                                    else
                                        echo "<li class='lista2'>Restan ".$dteDiff." días</li>";
                                    
                                    
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
                            {{$seminario->impartido}}
                        </td>
                        <td>
                            <ul>
                                <li class="lista{{$seminario->cronograma}}">Cronograma</li>
                                <li class="lista{{$seminario->programa}}">Programa</li>
                                <li class="lista{{$seminario->cv_expositores}}">CV de expositores</li>
                                <li class="lista{{$seminario->pago}}">Pago</li>
                                <li class="lista{{$seminario->rua}}">RUA</li>
                                <li class="lista{{$seminario->lista_oficial}}">Lista Oficial</li>
                                <li class="lista{{$seminario->relacion_asistencia}}">Relación de asistencia</li>
                                <li class="lista{{$seminario->evaluacion_final}}">Evaluación final</li>
                                <li class="lista{{$seminario->trabajos_finales}}">Trabajos finales</li>
                            </ul>
                        
                        <td width="17%">
                            
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_director', ['id' => $seminario->id]) . '")'
                            ])
                            @if($seminario->cronograma == 1 && $seminario->programa == 1 && $seminario->cv_expositores == 1 && $seminario->pago == 1 && $seminario->rua == 1)
                                @include('elementos_html.button', [
                                    'class' => 'yellow margen-boton-accion',
                                    'icono' => 'envelope outline',
                                    'popup' => 'Generar memorandum',
                                    'onclick' => 'redireccionar("' . route('editar_director', ['id' => $seminario->id]) . '")'
                                ])
                            @endif
                            @include('elementos_html.button', [
                                'class' => 'black margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Generar respuesta',
                                'onclick' => 'abrirModal("eliminar_' . $seminario->id . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'green margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Generar constancia',
                                'onclick' => 'abrirModal("eliminar_' . $seminario->id . '")'
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
                                    <form id="form_eliminar_{{$seminario->id}}" method="post" action="{{route('eliminar_director', ['id' => $seminario->id])}}" class="ui form">
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