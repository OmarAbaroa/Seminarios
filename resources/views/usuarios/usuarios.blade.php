@extends('plantilla')

@section('titulo', 'Usuarios')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Usuarios</h1>
    </div>
    <br/>
    <div class="ui styled fluid accordion">
        <div class="title">
            <i class="search icon"></i>
            Buscar por:
        </div>
        <div class="content">
            <form method="get">
                <div class="ui form">
                    <div class="fields">
                        @include('elementos_html.input_field', [
                            'id' => 'filtro_usuario',
                            'nombre' => 'filtro_usuario',
                            'etiqueta' => 'Nombre de usuario',
                            'placeholder' => 'Nombre de usuario',
                            'anterior' => old('filtro_usuario'),
                            'class' => 'six wide'
                        ])
                        @include('elementos_html.input_field', [
                            'id' => 'filtro_email',
                            'nombre' => 'filtro_email',
                            'etiqueta' => 'Correo electrónico',
                            'placeholder' => 'Correo electrónico',
                            'anterior' => old('filtro_email'),
                            'class' => 'six wide'
                        ])
                        @include('elementos_html.select_field', [
                            'id' => 'filtro_tipo_usuario',
                            'nombre' => 'filtro_tipo_usuario',
                            'etiqueta' => 'Tipo de usuario',
                            'sin_seleccion' => 'Todos',
                            'anterior' => old('filtro_tipo_usuario'),
                            'elementos' => $tipos,
                            'texto_filtro_todos' => 'Todos',
                            'class' => 'four wide'
                        ])
                    </div>
                </div>
                <div class="ui divider"></div>
                <div class="ui grid container">
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
                                'onclick' => 'redireccionar("' . route('usuarios') . '")'
                            ])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    @include('elementos_html.button', [
        'class' => 'primary labeled',
        'etiqueta' => 'Crear usuario',
        'icono' => 'plus',
        'tipo' => 'button',
        'onclick' => 'redireccionar("' . route('crear_usuario') .'")'
    ])
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Nombre de usuario
                </th>
                <th>
                    Correo electrónico
                </th>
                <th>
                    Tipo de usuario
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($usuarios) > 0)
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>
                            {{$usuario->nombre}}
                        </td>
                        <td>
                            {{$usuario->email}}
                        </td>
                        <td>
                            {{$usuario->tipo->nombre}}
                        </td>
                        <td>
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_usuario', ['id' => $usuario->id]) . '")'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $usuario->id . '")'
                            ])
                            <div id="eliminar_{{$usuario->id}}" class="ui modal">
                                <div class="header">Eliminar usuario</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$usuario->id}}" method="post" action="{{route('eliminar_usuario', ['id' => $usuario->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar al usuario <b>{{$usuario->nombre}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $usuario->id . '")'
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
                        Sin registros
                    </td>
                </tr>
            @endif
        </tbody>
        {{$usuarios->links()}}
    </table>
@endsection