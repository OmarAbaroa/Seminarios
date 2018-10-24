@extends('plantilla')

@section('titulo', 'Cargar alumnos')

@push('js')
    <script src="/js/modulos/alumnos/cargar_alumnos.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Cargar alumnos</h1>
    </div>
    <br/>
    <form id="form_cargar_alumnos" method="post" class="ui form" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="three fields">
            @include('elementos_html.input_field', [
                'id' => 'intervalo',
                'nombre' => 'intervalo',
                'etiqueta' => 'Intervalo',
                'placeholder' => 'Ej: 5-7',
                'anterior' => old('intervalo'),
                'class' => 'required'
            ])
            @include('elementos_html.search_id', [
                'id' => 'seminario',
                'nombre' => 'seminario',
                'etiqueta' => 'Seminario',
                'class' => 'required',
                'actual' => isset($seminario)? $seminario->UnidadAcademica->siglas : '',
                'anterior_id' => old('seminario'),
                'actual_id' => isset($seminario)? $seminario : '',
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