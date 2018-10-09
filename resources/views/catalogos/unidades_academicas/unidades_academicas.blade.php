@extends('plantilla')

@section('titulo', 'Unidades Académicas')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Unidades Académicas</h1>
    </div>
    <br/>
    <div class="ui styled fluid accordion">
        <div class="title">
            <i class="search icon"></i>
            Buscar por:
        </div>
        <div class="content">
            <form method="get" class="ui form">
                <div class="fields">
                    @include('elementos_html.input_field', [
                        'id' => 'filtro_nombre',
                        'nombre' => 'filtro_nombre',
                        'etiqueta' => 'Nombre o acrónimo',
                        'placeholder' => 'Nombre o acrónimo',
                        'anterior' => old('filtro_nombre'),
                        'class' => 'thirteen wide'
                    ])
                    @include('elementos_html.input_field', [
                        'id' => 'filtro_clave',
                        'nombre' => 'filtro_clave',
                        'etiqueta' => 'Clave',
                        'placeholder' => 'Clave',
                        'anterior' => old('filtro_clave'),
                        'class' => 'three wide'
                    ])
                </div>
                @include('elementos_html.select_field', [
                    'id' => 'filtro_area',
                    'nombre' => 'filtro_area',
                    'etiqueta' => 'Área',
                    'sin_seleccion' => 'Todas',
                    'anterior' => old('filtro_area'),
                    'elementos' => $areas,
                    'texto_filtro_todos' => 'Todas'
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
                                'onclick' => 'redireccionar("' . route('unidades_academicas') . '")'
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
        'onclick' => 'redireccionar("' . route('catalogos') .'")'
    ])
    @include('elementos_html.button', [
        'class' => 'primary labeled margen-boton-accion',
        'etiqueta' => 'Crear Unidad Académica',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('crear_unidad_academica') .'")'
    ])
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Acrónimo
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Clave
                </th>
                <th>
                    Área
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($unidades_academicas) > 0)
                @foreach($unidades_academicas as $unidad_academica)
                    <tr>
                        <td>
                            {{$unidad_academica->siglas}}
                        </td>
                        <td>
                            {{$unidad_academica->nombre}}
                        </td>
                        <td>
                            {{$unidad_academica->clave}}
                        </td>
                        <td>
                            {{$unidad_academica->area->nombre}}
                        </td>
                        <td>
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_unidad_academica', ['id' => $unidad_academica->id]) . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'green margen-boton-accion',
                                'icono' => 'list',
                                'popup' => 'Programas Académicos',
                                'onclick' => 'redireccionar("' . route('unidades_academicas_programas_academicos', ['id_unidad_academica' => $unidad_academica->id]) . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $unidad_academica->id . '")'
                            ])
                            <div id="eliminar_{{$unidad_academica->id}}" class="ui modal">
                                <div class="header">Eliminar Unidad Académica</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$unidad_academica->id}}" method="post" action="{{route('eliminar_unidad_academica', ['id' => $unidad_academica->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar la Unidad Académica <b>{{$unidad_academica->siglas}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $unidad_academica->id . '")'
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
        {{$unidades_academicas->links()}}
    </table>
@endsection