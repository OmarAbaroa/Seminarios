@extends('plantilla')

@section('titulo', $accion . ' Director')

@push('js')
    <script src="/js/modulos/form_director.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} horario</h1>
    </div>
    <br/>
    <form id="form_horario" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($horario))
            {{method_field('put')}}
        @endif
        @include('elementos_html.input_field', [
            'id' => 'dia',
            'nombre' => 'dia',
            'etiqueta' => 'Día',
            'placeholder' => 'Día',
            'anterior' => old('dia'),
            'actual' => isset($horario)? $horario->dia : '',
            'class' => 'required'
        ])
        @include('elementos_html.input_field', [
            'id' => 'hora_inicio',
            'nombre' => 'hora_inicio',
            'etiqueta' => 'Hora de inicio',
            'placeholder' => 'Hora de inicio',
            'anterior' => old('hora_inicio'),
            'actual' => isset($horario)? $horario->hora_inicio : '',
            'class' => 'required',
            'tipo' => 'time'
        ])
        @include('elementos_html.input_field', [
            'id' => 'hora_final',
            'nombre' => 'hora_final',
            'etiqueta' => 'Hora de termino',
            'placeholder' => 'Hora de termino',
            'anterior' => old('hora_final'),
            'actual' => isset($horario)? $horario->hora_final : '',
            'class' => 'required',
            'tipo' => 'time'
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
                    'onclick' => 'redireccionar("' . route('impartir_seminario') . '")'
                ])
            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection