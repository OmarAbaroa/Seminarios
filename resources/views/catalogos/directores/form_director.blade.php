@extends('plantilla')

@section('titulo', $accion . ' Director')

@push('js')
    <script src="/js/modulos/form_director.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} Director</h1>
    </div>
    <br/>
    <form id="form_director" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($director))
            {{method_field('put')}}
        @endif
        @include('elementos_html.input_field', [
            'id' => 'nombre',
            'nombre' => 'nombre',
            'etiqueta' => 'Nombre',
            'placeholder' => 'Nombre',
            'anterior' => old('nombre'),
            'actual' => isset($director)? $director->nombre_cargo : '',
            'class' => 'required'
        ])
        @include('elementos_html.input_field', [
            'id' => 'cargo',
            'nombre' => 'cargo',
            'etiqueta' => 'Cargo',
            'placeholder' => 'Cargo',
            'anterior' => old('cargo'),
            'actual' => isset($director)? $director->cargo : '',
            'class' => 'required'
        ])
        @include('elementos_html.select_field', [
            'id' => 'unidad_academica',
            'nombre' => 'unidad_academica',
            'etiqueta' => 'Unidad Académica',
            'sin_seleccion' => 'Seleccione una unidad académica',
            'anterior' => old('unidad_academica'),
            'elementos' => $unidades_academicas,
            'class' => 'required',
            'campo_nombre' => 'siglas',
        ])

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
                    'onclick' => 'redireccionar("' . session('url_directores') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection