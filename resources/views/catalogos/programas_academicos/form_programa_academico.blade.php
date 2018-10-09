@extends('plantilla')

@section('titulo', $accion . ' Programa Académico')

@push('js')
    <script src="/js/modulos/form_programa_academico.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} Programa Académico</h1>
    </div>
    <br/>
    <form id="form_programa_academico" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($programa_academico))
            {{method_field('put')}}
        @endif
        @include('elementos_html.input_field', [
            'id' => 'nombre',
            'nombre' => 'nombre',
            'etiqueta' => 'Nombre',
            'placeholder' => 'Nombre',
            'anterior' => old('nombre'),
            'actual' => isset($programa_academico)? $programa_academico->nombre : '',
            'class' => 'required'
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
                    'onclick' => 'redireccionar("' . session('url_programas_academicos') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection