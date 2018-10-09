<div class="ui checkbox">
    @if(isset($anterior_referencia) && $anterior_referencia)
        @if(isset($anterior) && $anterior)
            <input id="{{$id or ''}}" name="{{$nombre or ''}}" type="checkbox" class="hidden" tabindex="0" checked>
        @else
            <input id="{{$id or ''}}" name="{{$nombre or ''}}" type="checkbox" class="hidden" tabindex="0">
        @endif
    @else
        @if(isset($actual) && $actual)
            <input id="{{$id or ''}}" name="{{$nombre or ''}}" type="checkbox" class="hidden" tabindex="0" checked>
        @else
            <input id="{{$id or ''}}" name="{{$nombre or ''}}" type="checkbox" class="hidden" tabindex="0">
        @endif
    @endif
    <label for="{{$id or ''}}">{{$etiqueta or ''}}</label>
</div>