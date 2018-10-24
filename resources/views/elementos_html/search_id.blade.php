<div class="ui category search field {{$class or ''}}">
    <label class="{{$class_label or ''}}">{{$etiqueta or ''}}</label>
    <div class="ui icon input">
        @if(isset($anterior))
            <input class="prompt" id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}" value="{{$anterior}}" maxlength="{{$max or 255}}">
        @elseif(isset($actual))
            <input class="prompt" id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}" value="{{$actual}}" maxlength="{{$max or 255}}">
        @else
            <input class="prompt" id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}" maxlength="{{$max or 255}}">
        @endif
        <i class="search icon"></i>
    </div>
    <div class="results"></div>
    @if(isset($anterior_id))
        <input id="{{$id or ''}}_id" name="{{$nombre or ''}}_id" type="hidden" value="{{$anterior_id}}"/>
    @elseif(isset($actual_id))
        <input id="{{$id or ''}}_id" name="{{$nombre or ''}}_id" type="hidden" value="{{$actual_id}}"/>
    @else
        <input id="{{$id or ''}}_id" name="{{$nombre or ''}}_id" type="hidden"/>
    @endif
</div>
