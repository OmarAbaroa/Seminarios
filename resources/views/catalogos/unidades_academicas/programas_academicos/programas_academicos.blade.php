@extends('plantilla')

@section('titulo', 'Programas Académicos de ' . $unidad_academica->nombre)

@push('js')
    <script src="/js/modulos/programas_academicos.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Programas Académicos de {{$unidad_academica->nombre}}</h1>
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
                    'id' => 'filtro_nombre_pa',
                    'nombre' => 'filtro_nombre_pa',
                    'etiqueta' => 'Nombre',
                    'placeholder' => 'Nombre',
                    'anterior' => old('filtro_nombre_pa'),
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
                                'onclick' => 'redireccionar("' . route('unidades_academicas_programas_academicos', ['id_unidad_academica' => $unidad_academica->id]) . '")'
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
        'onclick' => 'redireccionar("' . session('url_unidades_academicas') .'")'
    ])
    @include('elementos_html.button', [
        'class' => 'primary labeled margen-boton-accion',
        'etiqueta' => 'Agregar Programa Académico',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'abrirModal("agregar_programa_academico")'
    ])
    <div id="agregar_programa_academico" class="ui modal">
        <div class="header">Agregar Programa Académico</div>
        <div class="content">
            <form id="form_agregar_programa_academico" method="post" action="{{route('almacenar_unidad_academica_programa_academico')}}" class="ui form" onsubmit="return agregarProgramaAcademico()">
                <p>
                    Seleccione el Programa Académico que se agregará a la Unidad Académica <b>{{$unidad_academica->siglas}}</b>.
                </p>
                {{csrf_field()}}
                <input type="hidden" name="unidad_academica" value="{{$unidad_academica->id}}"/>
                @include('elementos_html.select_field', [
                    'id' => 'programa_academico',
                    'nombre' => 'programa_academico',
                    'etiqueta' => 'Programa Académico',
                    'sin_seleccion' => 'Seleccione el Programa Académico',
                    'anterior' => old('programa_academico'),
                    'elementos' => $programas_academicos_select,
                    'class' => 'required'
                ])
                <div class="ui error message"></div>
            </form>
        </div>
        <div class="actions">
            @include('elementos_html.button', [
                'class' => 'green',
                'etiqueta' => 'Agregar',
                'onclick' => 'enviarForm("form_agregar_programa_academico")'
            ])
            <div class="ui red cancel button">Cancelar</div>
        </div>
        <div class="ui inverted dimmer">
            <div class="ui text loader">Espere un momento</div>
        </div>
    </div>
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($programas_academicos) > 0)
                @foreach($programas_academicos as $programa_academico)
                    <?php $unidad_academica_programa_academico = $programa_academico->unidades_academicas_programas_academicos->first(); ?>
                    <tr>
                        <td>
                            {{$programa_academico->nombre}}
                        </td>
                        <td>
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $unidad_academica_programa_academico->id . '")'
                            ])
                            <div id="eliminar_{{$unidad_academica_programa_academico->id}}" class="ui modal">
                                <div class="header">Eliminar Programa Académico</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$unidad_academica_programa_academico->id}}" method="post" action="{{route('eliminar_unidad_academica_programa_academico', ['id' => $unidad_academica_programa_academico->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el Programa Académico <b>{{$programa_academico->nombre}}</b>
                                            de la Unidad Académica <b>{{$unidad_academica->siglas}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $unidad_academica_programa_academico->id . '")'
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
        {{$programas_academicos->links()}}
    </table>
@endsection