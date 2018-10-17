@extends('plantilla')

@section('titulo', 'Cargar expositores')

@push('js')
    <script src="/js/modulos/expositores/cargar_expositores.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Cargar expositores</h1>
    </div>
    <br/>
    <form id="form_cargar_expositores" method="post" class="ui form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="two fields">
            @include('elementos_html.input_field', [
                'id' => 'intervalo',
                'nombre' => 'intervalo',
                'etiqueta' => 'Intervalo',
                'placeholder' => 'Ej: 5-7',
                'anterior' => old('intervalo'),
                'class' => 'required'
            ])
            @include('elementos_html.input_file', [
                'id' => 'archivo',
                'nombre' => 'archivo',
                'etiqueta' => 'Archivo',
                'placeholder' => 'Seleccione su archivo',
                'class' => 'required',
                'class_boton' => 'primary',
                'accept' => '.xls, .xlsx, .xlsm'
            ])
        </div>
        <div class="ui grid">
            <div class="row centered">
                @include('elementos_html.button', [
                    'class' => 'primary cargar',
                    'etiqueta' => 'Cargar',
                    'tipo' => 'submit'
                ])
            </div>
        </div>

        <div class="ui error message"></div>
    </form>
@endsection