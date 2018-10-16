@extends('plantilla')

@section('titulo', $accion . ' seminario')

@push('js')
    <script src="/js/modulos/seminarios/form_impartir_seminario.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} seminario "{{$seminario->nombre}}"</h1>
    </div>
    <br/>
    <form id="form_impartir_seminario_periodo" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($seminario))
            {{method_field('put')}}
        @endif
        <div class="three fields">
            @if($seminario->periodo_inicio)
                <?php 
                    $_fecha = explode('-',$seminario->periodo_inicio);
                    $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                ?>
                @include('elementos_html.input_field', [
                    'id' => 'periodo_inicio',
                    'nombre' => 'periodo_inicio',
                    'etiqueta' => 'Fecha de inicio de periodo',
                    'placeholder' => 'Fecha de inicio de periodo',
                    'actual' => $fecha,
                    'class' => 'required calendario',
                ])
            @else($seminario->periodo_inicio == NULL)
                @include('elementos_html.input_field', [
                    'id' => 'periodo_inicio',
                    'nombre' => 'periodo_inicio',
                    'etiqueta' => 'Fecha de inicio de periodo',
                    'placeholder' => 'Fecha de inicio de periodo',
                    'actual' => 'NULL',
                    'class' => 'required calendario',
                    
                ])
            @endif
            @if($seminario->periodo_fin)
                <?php 
                    $_fecha = explode('-',$seminario->periodo_fin);
                    $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                ?>
                @include('elementos_html.input_field', [
                    'id' => 'periodo_fin',
                    'nombre' => 'periodo_fin',
                    'etiqueta' => 'Fecha de fin de periodo',
                    'placeholder' => 'Fecha de din de periodo',
                    'actual' => $fecha,
                    'class' => 'required calendario',
                ])
            @else($seminario->periodo_fin == NULL)
                @include('elementos_html.input_field', [
                    'id' => 'periodo_fin',
                    'nombre' => 'periodo_fin',
                    'etiqueta' => 'Fecha de fin de periodo',
                    'placeholder' => 'Fecha de fin de periodo',
                    'actual' => 'NULL',
                    'class' => 'required calendario',
                    
                ])
            @endif
            @include('elementos_html.input_field',[
                'id' => 'impartido',
                'nombre' => 'impartido',
                'etiqueta' => 'El seminario se impartió',
                'placeholder' => 'veces',
                'anterior' => old('impartido'),
                'actual' => $seminario->impartido,
            ])
            
        </div>
        <div class="ui grid">
            <div class="row centered">
                @include('elementos_html.button', [
                    'class' => 'primary cargar',
                    'etiqueta' => $boton,
                    'tipo' => 'submit'
                ])
                @include('elementos_html.button', [
                    'class' => 'red cargar cancelar',
                    'etiqueta' => 'Cancelar',
                    'onclick' => 'redireccionar("' . route('impartir_seminario') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
    @if($seminario->periodo_inicio <> NULL && $seminario->periodo_fin <> NULL && $seminario->vigencia_inicio <> NULL && $seminario->vigencia_fin <> NULL )
        @include('elementos_html.button', [
            
            'class' => 'primary labeled margen-boton-accion',
            'etiqueta' => 'Cargar horario',
            'icono' => 'table',
            'tipo' => 'button',
            'onclick' => 'abrirModal("cargar_horario")'
        ])
    @endif
        
        <br>
        <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Día
                </th>
                <th>
                    Hora de inicio
                </th>
                <th>
                    Hora de fin
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($horarios) > 0)
                @foreach($horarios as $horario)
                    <tr>
                        <td>
                            {{$horario->dia}}
                        </td>
                        <td>
                            {{$horario->hora_inicio}}
                        </td>
                        <td>
                            {{$horario->hora_final}}
                        </td>
                        <td>
                           
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $horario->id . '")'
                            ])
                            
                            <div id="eliminar_{{$horario->id}}" class="ui modal">
                                <div class="header">Eliminar horario</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$horario->id}}" method="post" action="{{route('eliminar_horario', ['id' => $horario->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el horario <b>{{$horario->dia}} de {{$horario->hora_inicio}} a {{$horario->hora_final}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $horario->id . '")'
                                    ])
                                    <div class="ui red cancel button">No</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="ui center aligned">
                        No hay horarios registrados para {{$seminario->nombre}}
                    </td>
                </tr>
            @endif
        </tbody>
        
    </table>

        
        
    

    <div id="cargar_horario" class="ui modal">
        <div class="header">Cargar horario</div>
        <div class="content">
            <form id="form_cargar_horario" class="ui form" onsubmit="return cargarHorario()">
                {{method_field('patch')}}
                @include('elementos_html.input_field', [
                    'id' => 'id_seminario',
                    'nombre' => 'id_seminario',
                    'tipo' => 'hidden',
                    'actual' => $seminario->id
                ])
                @include('elementos_html.input_field', [
                    'id' => 'dia',
                    'nombre' => 'dia',
                    'tipo' => 'text',
                    'etiqueta' => 'Día',
                    'placeholder' => 'Día',
                    'class' => 'required',
                ])
                @include('elementos_html.input_field', [
                    'id' => 'hora_inicio',
                    'nombre' => 'hora_inicio',
                    'tipo' => 'time',
                    'etiqueta' => 'Hora de inicio',
                    'placeholder' => 'Hora de inicio',
                    'class' => 'required',
                ])
                @include('elementos_html.input_field', [
                    'id' => 'hora_final',
                    'nombre' => 'hora_final',
                    'tipo' => 'time',
                    'etiqueta' => 'Hora de termino',
                    'placeholder' => 'Hora de termino',
                    'class' => 'required',
                ])
            
                <div class="ui error message"></div>
            </form>
        </div>
        <div class="actions">
            @include('elementos_html.button', [
                'class' => 'green',
                'etiqueta' => 'Guardar',
                'onclick' => 'enviarForm("form_cargar_horario")'
            ])
            <div class="ui red cancel button">Cancelar</div>
        </div>
        <div class="ui inverted dimmer">
            <div class="ui text loader">Espere un momento</div>
        </div>
    </div>
@endsection