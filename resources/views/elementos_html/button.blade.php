<button class="ui {{$class or ''}} {{isset($icono)? 'icon':''}} button" type="{{$tipo or 'button'}}" 
    @if(isset($popup))
        data-tooltip="{{$popup or ''}}"
    @endif
onclick="{{$onclick or ''}}">
    @if(isset($icono))
        <i class="{{$icono}} icon"></i>
    @endif
    {{$etiqueta or ''}}
</button>