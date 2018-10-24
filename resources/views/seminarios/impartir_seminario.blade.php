@extends('plantilla')

@section('titulo', 'Seminarios')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Impartir seminarios</h1>
    </div>
    <br/>
    <div class="ui center aligned container">
        <div class="title">
            <i class="search icon"></i>
            Buscar por:
        </div>
        <div class="content">
            <form method="get" class="ui form">
                @include('elementos_html.input_field', [
                    'id' => 'filtro_nombre',
                    'nombre' => 'filtro_nombre',
                    'etiqueta' => 'Nombre',
                    'placeholder' => 'Nombre',
                    'anterior' => old('filtro_nombre')
                ])
                <div class="ui divider"></div>
                <div class="ui grid">
                    <div class="row">
                        <div class="right aligned column">
                            @include('elementos_html.button', [
                                'class' => 'primary cargar',
                                'popup' => 'Buscar',
                                'icono' => 'search',
                                'tipo' => 'submit'
                            ])
                            @include('elementos_html.button', [
                                'class' => 'red cargar',
                                'popup' => 'Limpiar campos',
                                'icono' => 'erase',
                                'onclick' => 'redireccionar("' . route('impartir_seminario') . '")'
                            ])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    
    <table class="ui celled striped table">
        <thead>
            <tr>

                <th>
                    Vigencia
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Registro
                </th>
                <th>
                    Unidad Académica
                </th>
                <th>
                    Impartido
                </th>
                <th>
                    Acciones
                </th>
            </tr>
        </thead>
        <tbody>
            @if(count($seminarios) > 0)
                @foreach($seminarios as $seminario)
                <?php 
                    $limite_inferior = $seminario->periodo_inicio;
                    $limite_superior = $seminario->periodo_fin;
                    $limite_aux = date("Y-m-d", strtotime($seminario->vigencia_fin.' + 2 months'));
                    //$limite_aux = $seminario->vigencia_fin;
                    if($seminario->periodo_fin <> NULL && $seminario->periodo_inicio <> NULL && $limite_aux < $seminario->periodo_inicio && $seminario->vigencia_fin < $seminario->periodo_fin)
                    {
                        $seminario->periodo_fin = NULL;
                        $seminario->periodo_inicio = NULL;

                        //Use App\Horario;
                        $horarios = App\Horario::DeSeminario($seminario->id)->get();
                        foreach($horarios as $horario){
                            $horario->delete();
                        }
                        $seminario->save();
                    }
                ?>
                    <tr>
                        <td>
                            <ul>
                            <?php
                                $sin_vigencia = 0;
                                if($seminario->vigencia_fin == NULL)    
                                    echo "<li class='lista0'>Sin registrar.</li>";
                                else
                                {
                                    $date1 = new DateTime($seminario->vigencia_fin);
                                    $date2 = new DateTime(date("Y-m-d"));
                                    $diff = $date1->diff($date2);
                                    
                                    if($diff->days <= 0 || date("Y-m-d") > $seminario->vigencia_fin)
                                    {
                                        //Significa que la vigencia se acabó
                                        echo "<li class='lista3'>Fuera de vigencia</li>"; 
                                        $sin_vigencia = 1;
                                    }
                                    elseif($diff->days > 0 && $diff->days <= env('PELIGRO_VIGENCIA'))
                                    {
                                        //Hay x días de vigencia
                                        echo "<li class='lista4'><b>Restan <i>".$diff->days."</i> días.</b></li>"; 
                                    }
                                    else{
                                        //La vigencia es mayor a x días
                                        echo "<li class='lista2'>Restan <b><i>".$diff->days."</i></b> días.</li>"; 
                                    }
                                }
                            ?>
                            </ul>
                        </td>
                        <td>
                            {{$seminario->nombre}}
                        </td>
                        <td>
                            <ul>
                            <?php
                                if($seminario->registro == NULL)
                                    echo "<li class='lista0'></li>";
                                else{
                                    echo $seminario->registro;
                                }
                            ?>
                            </ul>
                        </td>
                        <td>
                            {{$seminario->unidadAcademica->siglas}}
                        </td>
                        
                        <td>
                            {{$seminario->impartido}} veces
                        </td>
                        <td>
                            
                            @include('elementos_html.button', [
                                'class' => 'primary margen-boton-accion',
                                'icono' => 'edit',
                                'popup' => 'Editar',
                                'onclick' => 'redireccionar("' . route('editar_seminario', ['id' => $seminario->id, 'impartir' => 1]) . '")'
                            ])
                            @if($seminario->lista_inicial == 1 && $sin_vigencia == 0)
                                @include('elementos_html.button', [
                                    'class' => 'yellow margen-boton-accion',
                                    'icono' => 'table',
                                    'popup' => 'Asignar periodo y horarios',
                                    'onclick' => 'redireccionar("' . route('impartir_seminario_id', ['id' => $seminario->id]) . '")'
                                ])
                            @endif
                           
                            @if($seminario->cronograma == 1 && $seminario->programa == 1 && $seminario->cv_expositores == 1 && $seminario->pago == 1 && $seminario->rua == 1 && $seminario->lista_inicial == 1 && $seminario->acta_consejo == 1 && $seminario->aval_academico == 1 && $seminario->lista_oficial  == 1 && $seminario->relacion_asistencia == 1 && $seminario->evaluacion_final == 1 && $seminario->trabajos_finales == 1 && $sin_vigencia == 0) 
                                @include('elementos_html.button', [
                                    'class' => 'green margen-boton-accion',
                                    'icono' => 'archive',
                                    'popup' => 'Generar constancias',
                                    'onclick' => 'redireccionar("' . route('generar_constancia', ['id' => $seminario->id]) . '")'
                                ])
                            @endif
                            
                            @include('elementos_html.button', [
                                'class' => 'red margen-boton-accion',
                                'icono' => 'cancel',
                                'popup' => 'Eliminar',
                                'onclick' => 'abrirModal("eliminar_' . $seminario->id . '")'
                            ])
                            
                            <div id="eliminar_{{$seminario->id}}" class="ui modal">
                                <div class="header">Eliminar seminario</div>
                                <div class="content">
                                    <form id="form_eliminar_{{$seminario->id}}" method="post" action="{{route('eliminar_seminario', ['id' => $seminario->id])}}" class="ui form">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <p>
                                            ¿Seguro que desea eliminar el seminario <b>{{$seminario->nombre}}</b>?
                                        </p>
                                    </form>
                                </div>
                                <div class="actions">
                                    @include('elementos_html.button', [
                                        'class' => 'green ok cargar',
                                        'etiqueta' => 'Sí',
                                        'onclick' => 'enviarForm("form_eliminar_' . $seminario->id . '")'
                                    ])
                                    <div class="ui red cancel button">No</div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" class="ui center aligned">
                        Sin registros
                    </td>
                </tr>
            @endif
        </tbody>
        {{$seminarios->links()}}
    </table>
    
@endsection