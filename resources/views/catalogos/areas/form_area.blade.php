@extends('plantilla')

@section('titulo', $accion . ' área de Unidad Académica')

@push('js')
    <script src="/js/modulos/form_area.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} área de Unidad Académica</h1>
    </div>
    <br/>
    <form id="form_area" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($area))
            {{method_field('put')}}
        @endif
        @include('elementos_html.input_field', [
            'id' => 'nombre',
            'nombre' => 'nombre',
            'etiqueta' => 'Nombre',
            'placeholder' => 'Nombre',
            'anterior' => old('nombre'),
            'actual' => isset($area)? $area->nombre : '',
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
                    'onclick' => 'redireccionar("' . session('url_areas') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection