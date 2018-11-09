@extends('plantilla')

@section('titulo', 'Directores')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Directores</h1>
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
                                'onclick' => 'redireccionar("' . route('directores') . '")'
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
        'etiqueta' => 'Crear Director',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('crear_director') .'")'
    ])
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Cargo
                </th>
                <th>
                    Unidad Académica
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($directores) > 0)
                @foreach($directores as $director)
                    <tr>
                        <td>
                            {{$director->nombre_cargo}}
                        </td>
                        <td>
                            {{$director->cargo}}
                        </td>
                        <td>
                            {{$director->unidadAcademica->siglas}}
                        </td>
                        <td>
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_director', ['id' => $director->id]) . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $director->id . '")'
                            ])
                            <div id="eliminar_{{$director->id}}" class="ui modal">
                                <div class="header">Eliminar área de Unidad Académica</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$director->id}}" method="post" action="{{route('eliminar_director', ['id' => $director->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el área de Unidad Académica <b>{{$director->nombre_cargo}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $director->id . '")'
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
        {{$directores->links()}}
    </table>
@endsection