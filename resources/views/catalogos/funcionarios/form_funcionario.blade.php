@extends('plantilla')

@section('titulo', $accion . ' sexo')

@push('js')
    <script src="/js/modulos/form_funcionario.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} funcionario</h1>
    </div>
    <br/>
    <form id="form_funcionario" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($funcionario))
            {{method_field('put')}}
        @endif
        <div class="two fields">
            @include('elementos_html.input_field', [
                'id' => 'nombre',
                'nombre' => 'nombre',
                'etiqueta' => 'Nombre',
                'placeholder' => 'Nombre',
                'anterior' => old('nombre'),
                'actual' => isset($funcionario)? $funcionario->nombre : '',
                'class' => 'required'
            ])
            @include('elementos_html.input_field', [
                'id' => 'apellidos',
                'nombre' => 'apellidos',
                'etiqueta' => 'Apellidos',
                'placeholder' => 'Apellidos',
                'anterior' => old('apellidos'),
                'actual' => isset($funcionario)? $funcionario->apellidos : '',
                'class' => 'required'
            ])
            
        </div>
        <div class="three fields">
            @include('elementos_html.input_field', [
                    'id' => 'cargo',
                    'nombre' => 'cargo',
                    'etiqueta' => 'Cargo',
                    'placeholder' => 'Cargo',
                    'anterior' => old('cargo'),
                    'actual' => isset($funcionario)? $funcionario->cargo : '',
                    'class' => 'required'
                ])
            @include('elementos_html.select_field', [
                'id' => 'escolaridad',
                'nombre' => 'escolaridad',
                'etiqueta' => 'Escolaridad',
                'sin_seleccion' => 'Seleccione',
                'anterior' => old('escolaridad'),
                'elementos' => $escolaridades,
                'class' => 'required'
            ])
            @include('elementos_html.select_field', [
                'id' => 'sexo',
                'nombre' => 'sexo',
                'etiqueta' => 'Sexo',
                'sin_seleccion' => 'Seleccione',
                'anterior' => old('sexo'),
                'elementos' => $sexos,
                'class' => 'required'
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
                    'onclick' => 'redireccionar("' . session('url_funcionarios') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection