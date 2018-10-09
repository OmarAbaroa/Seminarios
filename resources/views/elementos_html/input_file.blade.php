<div class="field {{$class or ''}}">
    <label>{{$etiqueta or ''}}</label>
    <div class="ui fluid action input">
        <input id="{{$id or ''}}_txt" placeholder="{{$placeholder or ''}}" type="text" disabled>
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" class="oculto" type="file" accept="{{$accept or ''}}">
        <button id="{{$id}}_boton" class="ui {{$class_boton or ''}} labeled icon button" type="button" onclick="{{$onclick_boton or ''}}">
            <i class="folder open icon"></i>
            Examinar...
        </button>
    </div>
    <div class="row">
        <b>Tamaño máximo:</b>&nbsp;{{ini_get('post_max_size') . 'B'}}
    </div>
</div>