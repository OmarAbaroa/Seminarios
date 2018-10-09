@extends('plantilla')

@section('titulo', 'Áreas de Unidades Académicas')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Áreas de Unidades Académicas</h1>
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
                                'onclick' => 'redireccionar("' . route('areas') . '")'
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
        'etiqueta' => 'Crear área',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('crear_area') .'")'
    ])
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
            @if(count($areas) > 0)
                @foreach($areas as $area)
                    <tr>
                        <td>
                            {{$area->nombre}}
                        </td>
                        <td>
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_area', ['id' => $area->id]) . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $area->id . '")'
                            ])
                            <div id="eliminar_{{$area->id}}" class="ui modal">
                                <div class="header">Eliminar área de Unidad Académica</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$area->id}}" method="post" action="{{route('eliminar_area', ['id' => $area->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el área de Unidad Académica <b>{{$area->nombre}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $area->id . '")'
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
        {{$areas->links()}}
    </table>
@endsection