@extends('plantilla')

@section('titulo', $accion . ' usuario')

@push('js')
    <script src="/js/modulos/form_usuario.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} usuario</h1>
    </div>
    <br/>
    <form id="form_usuario" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($usuario))
            {{method_field('put')}}
        @endif
        <div class="two fields">
            @include('elementos_html.select_field', [
                'id' => 'tipo_usuario',
                'nombre' => 'tipo_usuario',
                'etiqueta' => 'Tipo de usuario',
                'sin_seleccion' => 'Seleccione el tipo de usuario',
                'anterior' => old('tipo_usuario'),
                'actual' => isset($usuario)? $usuario->id_tipo_usuario : '',
                'elementos' => $tipos,
                'class' => 'required'
            ])
            @include('elementos_html.input_field', [
                'id' => 'usuario',
                'nombre' => 'usuario',
                'etiqueta' => 'Nombre de usuario',
                'placeholder' => 'Nombre de usuario',
                'anterior' => old('usuario'),
                'actual' => isset($usuario)? $usuario->nombre : '',
                'class' => 'required'
            ])
        </div>
        @include('elementos_html.input_field', [
            'id' => 'email',
            'nombre' => 'email',
            'etiqueta' => 'Correo electrónico',
            'placeholder' => 'Correo electrónico',
            'anterior' => old('email'),
            'actual' => isset($usuario)? $usuario->email : '',
            'class' => 'required'
        ])
        @if(!isset($usuario))
            <div class="two fields">
                @include('elementos_html.input_field', [
                    'id' => 'password',
                    'nombre' => 'password',
                    'tipo' => 'password',
                    'etiqueta' => 'Contraseña',
                    'placeholder' => 'Contraseña',
                    'class' => 'required'
                ])
                @include('elementos_html.input_field', [
                    'id' => 'password_confirmation',
                    'nombre' => 'password_confirmation',
                    'tipo' => 'password',
                    'etiqueta' => 'Confirmar contraseña',
                    'placeholder' => 'Confirmar contraseña',
                    'class' => 'required'
                ])
            </div>
        @endif
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
                    'onclick' => 'redireccionar("' . session('url_usuarios') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection