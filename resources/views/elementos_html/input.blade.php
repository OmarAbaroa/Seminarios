<div class="ui {{$class or ''}} {{$alineacion or ''}} {{isset($icono)? 'icon':''}} {{isset($accion)? 'action':''}} input field">
    @if(isset($anterior) && $anterior)
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$etiqueta or ''}}" type="{{$tipo or 'text'}}" value="{{$anterior}}">
    @elseif(isset($actual) && $actual)
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$etiqueta or ''}}" type="{{$tipo or 'text'}}" value="{{$actual}}">
    @else
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$etiqueta or ''}}" type="{{$tipo or 'text'}}">
    @endif
    @if(isset($icono))
        <i class="{{$icono}} icon"></i>
    @endif
    @if(isset($accion))
        <button id="{{$id}}_boton" class="ui {{$class_boton or ''}} {{$accion? 'labeled':''}} {{isset($icono_boton)? 'icon':''}} button" type="{{$tipo_boton or 'button'}}" 
            @if(isset($popup))
                data-tooltip="{{$popup or ''}}"
            @endif
        onclick="{{$onclick_boton or ''}}">
            @if(isset($icono_boton))
                <i class="{{$icono_boton}} icon"></i>
            @endif
            {{$accion}}
        </button>
    @endif
</div>