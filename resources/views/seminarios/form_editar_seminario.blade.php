@extends('plantilla')

@section('titulo', $accion . ' seminario')

@push('js')
    <script src="/js/modulos/seminarios/form_editar_seminario.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">{{$accion}} seminario</h1>
    </div>
    <br/>
    <form id="form_editar_seminario" method="post" class="ui form">
        {{csrf_field()}}
        @if(isset($seminario))
            {{method_field('put')}}
        @endif
        <div class="three fields">
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
                'id' => 'registro',
                'nombre' => 'registro',
                'etiqueta' => 'Registro del seminario',
                'placeholder' => 'Nombre del seminario',
                'anterior' => old('registro'),
                'actual' => isset($seminario)? $seminario->registro : '',
                
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
        <div class="four fields">
            @include('elementos_html.select_field', [
                'id' => 'unidad_academica',
                'nombre' => 'unidad_academica',
                'etiqueta' => 'Unidad Académica',
                'sin_seleccion' => 'Seleccione la unidad académica',
                'anterior' => old('unidad_academica'),
                'elementos' => $unidades_academicas,
                'campo_nombre' => 'siglas',
                'actual' => isset($seminario)? $seminario->id_unidad_academica : '',
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
            @if($seminario->vigencia_inicio)
                <?php 
                    $_fecha = explode('-',$seminario->vigencia_inicio);
                    $fecha = $_fecha[2]."/".$_fecha[1]."/".$_fecha[0];
                ?>
                @include('elementos_html.input_field', [
                    'id' => 'vigencia_inicio',
                    'nombre' => 'vigencia_inicio',
                    'etiqueta' => 'Vigencia de inicio',
                    'placeholder' => 'Vigencia de inicio',
                    'actual' => $fecha,
                    'class' => 'calendario',
                    
                ])
            @endif
            @if($seminario->vigencia_inicio == NULL)
                @include('elementos_html.input_field', [
                    'id' => 'vigencia_inicio',
                    'nombre' => 'vigencia_inicio',
                    'etiqueta' => 'Vigencia de inicio',
                    'placeholder' => 'Vigencia de inicio',
                    'actual' => 'NULL',
                    'class' => 'calendario',
                    
                ])
            @endif
            @include('elementos_html.select_field', [
                'id' => 'tipo_seminario',
                'nombre' => 'tipo_seminario',
                'etiqueta' => 'Tipo del seminario',
                'sin_seleccion' => 'Seleccione un tipo',
                'anterior' => old('tipo_seminario'),
                'elementos' => $tipos_seminarios,
                'campo_nombre' => 'nombre',
                'class' => 'required',
                'actual' => isset($seminario)? $seminario->id_tipo_seminario : '',
            ])
        </div>
        <table class="ui celled striped table">
            <thead>
                <tr>
                    @if($impartir == 0)
                        <th colspan="7" class="ui center aligned"> 
                    @else
                        <th colspan="5" class="ui center aligned"> 
                    @endif
                        Seleccione los documentos entregados:
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @if($impartir == 0)
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'cronograma',
                                'nombre' => 'cronograma',
                                'etiqueta' => 'Cronograma',
                                'anterior' => old('cronograma'),
                                'actual' => isset($seminario)? $seminario->cronograma : '',
                            ]) 
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'programa',
                                'nombre' => 'programa',
                                'etiqueta' => 'Programa',
                                'anterior' => old('programa'),
                                'actual' => isset($seminario)? $seminario->programa : '',
                            ])
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'cv_expositores',
                                'nombre' => 'cv_expositores',
                                'etiqueta' => 'CV de expositores',
                                'anterior' => old('cv_expositores'),
                                'actual' => isset($seminario)? $seminario->cv_expositores : '',
                            ])    
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'pago',
                                'nombre' => 'pago',
                                'etiqueta' => 'Pago',
                                'anterior' => old('pago'),
                                'actual' => isset($seminario)? $seminario->pago : '',
                            ]) 
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'rua',
                                'nombre' => 'rua',
                                'etiqueta' => 'RUA',
                                'anterior' => old('rua'),
                                'actual' => isset($seminario)? $seminario->rua : '',
                            ])
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'acta_consejo',
                                'nombre' => 'acta_consejo',
                                'etiqueta' => 'Acta del consejo',
                                'anterior' => old('acta_consejo'),
                                'actual' => isset($seminario)? $seminario->acta_consejo : '',
                            ])
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'aval_academico',
                                'nombre' => 'aval_academico',
                                'etiqueta' => 'Aval académico',
                                'anterior' => old('aval_academico'),
                                'actual' => isset($seminario)? $seminario->aval_academico : '',
                            ])    
                        </td>
                    @else
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'lista_inicial',
                                'nombre' => 'lista_inicial',
                                'etiqueta' => 'Lista inicial',
                                'anterior' => old('lista_inicial'),
                                'actual' => isset($seminario)? $seminario->lista_inicial : '',
                            ]) 
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'lista_oficial',
                                'nombre' => 'lista_oficial',
                                'etiqueta' => 'Lista oficial',
                                'anterior' => old('lista_oficial'),
                                'actual' => isset($seminario)? $seminario->lista_oficial : '',
                            ])
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'relacion_asistencia',
                                'nombre' => 'relacion_asistencia',
                                'etiqueta' => 'Relación de asistencia',
                                'anterior' => old('relacion_asistencia'),
                                'actual' => isset($seminario)? $seminario->relacion_asistencia : '',
                            ])    
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'evaluacion_final',
                                'nombre' => 'evaluacion_final',
                                'etiqueta' => 'Evaluación final',
                                'anterior' => old('evaluacion_final'),
                                'actual' => isset($seminario)? $seminario->evaluacion_final : '',
                            ]) 
                        </td>
                        <td>
                            @include('elementos_html.checkbox', [
                                'id' => 'trabajos_finales',
                                'nombre' => 'trabajos_finales',
                                'etiqueta' => 'Trabajos finales',
                                'anterior' => old('trabajos_finales'),
                                'actual' => isset($seminario)? $seminario->trabajos_finales : '',
                            ])
                        </td>
                    @endif
                </tr>
                
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
                @if($impartir == 0)
                    @include('elementos_html.button', [
                        'class' => 'red cargar cancelar',
                        'etiqueta' => 'Cancelar',
                        'onclick' => 'redireccionar("' . session('url_seminarios') . '")'
                    ])
                @else
                    @include('elementos_html.button', [
                        'class' => 'red cargar cancelar',
                        'etiqueta' => 'Cancelar',
                        'onclick' => 'redireccionar("' . route('impartir_seminario') . '")'
                    ])
                @endif

            </div>
        </div>
        <div class="ui error message"></div>
    </form>
@endsection