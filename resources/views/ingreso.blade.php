@extends('plantilla')

@section('titulo', 'Autenticación')

@push('js')
    <script src="/js/modulos/autenticacion.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Autenticación</h1>
    </div>
    <br/>
    <form id="form_autenticacion" method="post" class="ui form">
        {{csrf_field()}}
        <div class="ui grid">
            <div class="row centered">
                @include('elementos_html.input', [
                    'id' => 'usuario',
                    'nombre' => 'usuario',
                    'alineacion' => 'left',
                    'icono' => 'user',
                    'etiqueta' => 'Usuario',
                    'anterior' => old('usuario')
                ])
            </div>
            <div class="row centered">
                @include('elementos_html.input', [
                    'id' => 'password',
                    'nombre' => 'password',
                    'tipo' => 'password',
                    'alineacion' => 'left',
                    'icono' => 'lock',
                    'etiqueta' => 'Contraseña',
                    'anterior' => ''
                ])
            </div>
            <div class="row centered">
                @include('elementos_html.checkbox', [
                    'id' => 'recordar',
                    'nombre' => 'recordar',
                    'etiqueta' => 'Mantener sesión iniciada',
                    'anterior_referencia' => old('usuario'),
                    'anterior' => old('recordar')
                ])
            </div>
            <div class="row centered">
                <a href="'recuperar'">¿Olvidaste tu contraseña?</a>
            </div>
            <div class="row centered">
                @include('elementos_html.button', [
                    'class' => 'primary cargar',
                    'etiqueta' => 'Enviar',
                    'tipo' => 'submit'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection