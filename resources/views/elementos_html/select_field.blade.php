<?php 
    if(!isset($campo_nombre))
    {
        $campo_nombre = 'nombre';
    }
?>
<div class="field {{$class or ''}}">
    <label>{{$etiqueta or ''}}</label>
    <select id="{{$id or ''}}" name="{{$nombre or ''}}" class="ui search dropdown">
        @if(isset($sin_seleccion))
            <option value="">{{$sin_seleccion}}</option>
        @endif
        @if(isset($texto_filtro_todos))
            <option value="0">{{$texto_filtro_todos}}</option>
        @endif
        @if(isset($elementos))
            @foreach($elementos as $elemento)
                @if(isset($anterior))
                    @if($anterior == $elemento->id)
                        <option value="{{$elemento->id}}" selected>{{$elemento->$campo_nombre}}</option>
                    @else
                        <option value="{{$elemento->id}}">{{$elemento->$campo_nombre}}</option>
                    @endif
                @elseif(isset($actual))
                    @if($actual == $elemento->id)
                        <option value="{{$elemento->id}}" selected>{{$elemento->$campo_nombre}}</option>
                    @else
                        <option value="{{$elemento->id}}">{{$elemento->$campo_nombre}}</option>
                    @endif
                @else
                    <option value="{{$elemento->id}}">{{$elemento->$campo_nombre}}</option>
                @endif
            @endforeach
        @endif
    </select>
</div>