@extends('plantilla')

@section('titulo', 'Generar reportes')

@push('js')
    <script src="/js/modulos/reportes.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Generar reportes</h1>
    </div>
    <div class="ui divider"></div>
    <div class="ui center aligned container">
        <h2 class="ui header">Reporte vigencia por trimestre</h2>
    </div>
    <br/>
    <form id="form_reporte_trimestre" method="post" action="{{route('reporte_trimestre')}}" class="ui form" target="_blank">
        {{csrf_field()}}
        <div class='two fields'>
            @include('elementos_html.select_field',[
                'id' => 'trimestre',
                'nombre' => 'trimestre',
                'class' => 'required',
                'etiqueta' => 'Trimestre',
                'elementos' => $trimestre,
                'sin_seleccion' => 'Seleccione'
            ])
            @include('elementos_html.input_field',[
                'id' => 'anio',
                'nombre' => 'anio',
                'class' => 'required',
                'placeholder' => 'Año',
                'etiqueta' => 'Año',
            ])
        </div>
        <div class="three fields">
            @include('elementos_html.input_field',[
                'id' => 'analista1',
                'nombre' => 'analista1',
                'etiqueta' => 'Analista',
                'placeholder' => 'Ej: Lic. ',
                'class' => 'required'
            ])
            @include('elementos_html.input_field',[
                'id' => 'analista2',
                'nombre' => 'analista2',
                'etiqueta' => 'Analista',
                'placeholder' => 'Opcional',
            ])
            @include('elementos_html.input_field',[
                'id' => 'analista3',
                'nombre' => 'analista3',
                'etiqueta' => 'Analista',
                'placeholder' => 'Opcional',
            ])
        </div>
        <div class="ui grid container">
            <div class="row centered">
                @include('elementos_html.button', [
                    'class' => 'primary',
                    'etiqueta' => 'Generar',
                    'tipo' => 'submit'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>


    <div class="ui divider"></div>
    <div class="ui center aligned container">
        <h2 class="ui header">Reporte seminarioas vigentes por Unidad Académica</h2>
    </div>
    <br/>
    <form id="form_reporte_vigente_ua" method="post" action="{{route('reporte_vigentes_ua')}}" class="ui form" target="_blank">
        {{csrf_field()}}
            @include('elementos_html.select_field',[
                'id' => 'unidad_academica',
                'nombre' => 'unidad_academica',
                'campo_nombre' => 'siglas',
                'etiqueta' => 'Unidad Académica',
                'elementos' => $ua,
                'sin_seleccion' => 'Todas'
            ])
            
        <div class="ui grid container">
            <div class="row centered">
                @include('elementos_html.button', [
                    'class' => 'primary',
                    'etiqueta' => 'Generar',
                    'tipo' => 'submit'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
    
@endsection