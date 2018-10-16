@extends('plantilla')

@section('titulo', $accion . ' seminario')

@push('js')
    <script src="/js/modulos/seminarios/form_crear_seminario.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} seminario</h1>
    </div>
    <br/>
    <form id="form_crear_seminario" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($seminario))
            {{method_field('put')}}
        @endif
        <div class="two fields">
            @include('elementos_html.input_field', [
                'id' => 'nombre',
                'nombre' => 'nombre',
                'etiqueta' => 'Nombre del seminario',
                'placeholder' => 'Nombre del seminario',
                'anterior' => old('nombre'),
                'actual' => isset($seminario)? $seminario->nombre : '',
                'class' => 'required'
            ])
            @include('elementos_html.input_field', [
                'id' => 'duracion ',
                'nombre' => 'duracion',
                'etiqueta' => 'Duración del seminario',
                'placeholder' => 'Duración del seminario',
                'anterior' => old('duracion'),
                'actual' => isset($seminario)? $seminario->duracion : '',
                'class' => 'required'
            ])
        </div>
        <div class="three fields">
            @include('elementos_html.select_field', [
                'id' => 'unidad_academica',
                'nombre' => 'unidad_academica',
                'etiqueta' => 'Unidad Académica',
                'sin_seleccion' => 'Seleccione la unidad académica',
                'anterior' => old('unidad_academica'),
                'elementos' => $unidades_academicas,
                'campo_nombre' => 'siglas',
                'class' => 'required',
            ])
            @include('elementos_html.input_field', [
                'id' => 'sede',
                'nombre' => 'sede',
                'etiqueta' => 'Sede del seminario',
                'placeholder' => 'Sede del seminario',
                'anterior' => old('sede'),
                'actual' => isset($seminario)? $seminario->sede : '',
            ])
            @include('elementos_html.select_field', [
                'id' => 'tipo_seminario',
                'nombre' => 'tipo_seminario',
                'etiqueta' => 'Tipo del seminario',
                'sin_seleccion' => 'Seleccione un tipo',
                'anterior' => old('tipo_seminario'),
                'elementos' => $tipos_seminarios,
                'campo_nombre' => 'nombre',
                'class' => 'required',
            ])
        </div>
        
        <table class="ui celled striped table">
            <thead>
                <tr>
                    <th colspan="8" class="ui center aligned"> 
                        Seleccione los documentos entregados:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'cronograma',
                            'nombre' => 'cronograma',
                            'etiqueta' => 'Cronograma',
                            'anterior' => old('cronograma'),
                            
                        ]) 
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'programa',
                            'nombre' => 'programa',
                            'etiqueta' => 'Programa',
                            'anterior' => old('programa')
                        ])
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'cv_expositores',
                            'nombre' => 'cv_expositores',
                            'etiqueta' => 'CV de expositores',
                            'anterior' => old('cv_expositores')
                        ])    
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'pago',
                            'nombre' => 'pago',
                            'etiqueta' => 'Pago',
                            'anterior' => old('pago')
                        ]) 
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'rua',
                            'nombre' => 'rua',
                            'etiqueta' => 'RUA',
                            'anterior' => old('rua')
                        ])
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'acta_consejo',
                            'nombre' => 'acta_consejo',
                            'etiqueta' => 'Acta del consejo',
                            'anterior' => old('acta_consejo')
                        ])
                    </td>
                    <td>
                        @include('elementos_html.checkbox', [
                            'id' => 'aval_academico',
                            'nombre' => 'aval_academico',
                            'etiqueta' => 'Aval Académico',
                            'anterior' => old('aval_academico')
                        ])
                    </td>       
            </tbody>
        </table>
        <br>
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
                    'onclick' => 'redireccionar("' . session('url_seminarios') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection