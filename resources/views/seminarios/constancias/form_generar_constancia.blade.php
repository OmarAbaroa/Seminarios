@extends('plantilla')

@section('titulo', 'Generar constancias')

@push('js')
    <script src="/js/modulos/seminarios/form_generar_constancia.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Generar constancias</h1>
    </div>
    <br/>
    @include('elementos_html.button', [
        'class' => 'yellow margen-boton-accion',
        'icono' => 'plus',
        'etiqueta' => 'Generar oficio',
        'popup' => 'Constancias',
        'onclick' => 'redireccionar("' . route('generar_oficio_constancia',['id' => $seminario]) . '")'
    ])
    <br>
    <form id="form_generar_constancia" method="post" class="ui form" enctype="multipart/form-data" target="_blank">
        {{csrf_field()}}
        @include('elementos_html.input_field',[
                'id' => 'id_seminario',
                'nombre' => 'id_seminario',
                'actual' => $seminario,
                'tipo' => 'hidden',
            ])
        <div class="two fields">
            <?php
                $elemento1 = new stdClass();
                $elemento2 = new stdClass();
                $elemento1->id = 1;
                $elemento1->nombre = 'Alumnos';
                $elemento2->id = 2;
                $elemento2->nombre = 'Expositores';

                $elementos = array($elemento1, $elemento2);
            ?>
            
            @include('elementos_html.select_field', [
                'id' => 'opcion',
                'nombre' => 'opcion',
                'etiqueta' => 'Seleccione',
                'sin_seleccion' => 'Seleccione',
                'anterior' => old('opcion'),
                'elementos' => $elementos,
                'class' => 'required'
            ])
            @include('elementos_html.input_field', [
                'id' => 'intervalo',
                'nombre' => 'intervalo',
                'etiqueta' => 'Intervalo',
                'placeholder' => 'Ej: 1,3,4, 5-7',
                'anterior' => old('intervalo'),
                'class' => 'required'
            ])
        </div>
        <div class="two fields">
            @include('elementos_html.input_field', [
                'id' => 'iniciales',
                'nombre' => 'iniciales',
                'etiqueta' => 'Iniciales',
                'placeholder' => 'Solo analista',
                'anterior' => old('iniciales'),
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
                    'tipo' => 'submit',
                ])
            </div>
        </div>

        <div class="ui error message"></div>
    </form>
@endsection