<div class="field {{$class or ''}}">
    <label>{{$etiqueta or ''}}</label>
    @if(isset($anterior) && $anterior)
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}" value="{{$anterior}}">
    @elseif(isset($actual) && $actual)
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}" value="{{$actual}}">
    @else
        <input id="{{$id or ''}}" name="{{$nombre or ''}}" placeholder="{{$placeholder or ''}}" type="{{$tipo or 'text'}}">
    @endif
</div>