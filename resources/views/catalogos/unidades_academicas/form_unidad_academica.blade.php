@extends('plantilla')

@section('titulo', $accion . ' Unidad Académica')

@push('js')
    <script src="/js/modulos/form_unidad_academica.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} Unidad Académica</h1>
    </div>
    <br/>
    <form id="form_unidad_academica" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($unidad_academica))
            {{method_field('put')}}
        @endif
        <div class="three fields">
            @include('elementos_html.input_field', [
                'id' => 'siglas',
                'nombre' => 'siglas',
                'etiqueta' => 'Acrónimo',
                'placeholder' => 'Acrónimo',
                'anterior' => old('siglas'),
                'actual' => isset($unidad_academica)? $unidad_academica->siglas : '',
                'class' => 'required four wide'
            ])
            @include('elementos_html.input_field', [
                'id' => 'nombre',
                'nombre' => 'nombre',
                'etiqueta' => 'Nombre',
                'placeholder' => 'Nombre',
                'anterior' => old('nombre'),
                'actual' => isset($unidad_academica)? $unidad_academica->nombre : '',
                'class' => 'required ten wide'
            ])
        @include('elementos_html.input_field', [
                'id' => 'clave',
                'nombre' => 'clave',
                'etiqueta' => 'Clave',
                'placeholder' => 'Clave',
                'anterior' => old('clave'),
                'actual' => isset($unidad_academica)? $unidad_academica->clave : '',
                'class' => 'required two wide'
            ])
            
        </div>
            @include('elementos_html.select_field', [
                'id' => 'area',
                'nombre' => 'area',
                'etiqueta' => 'Área',
                'sin_seleccion' => 'Seleccione el área de la Unidad Académica',
                'anterior' => old('area'),
                'actual' => isset($unidad_academica)? $unidad_academica->id_area : '',
                'elementos' => $areas,
                'class' => 'required'
            ])
            @include('elementos_html.checkbox', [
                'id' => 'rvoe',
                'nombre' => 'rvoe',
                'etiqueta' => '¿Pertenece a RVOE?',
                'anterior' => old('rvoe'),                
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
                    'onclick' => 'redireccionar("' . session('url_unidades_academicas') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection