@if(session('mensaje_exito'))
    <div class="ui success message">
        <i class="close icon"></i>
        <i class="check circle icon"></i>
        {{session('mensaje_exito')}}
    </div>
@elseif(session('mensaje_advertencia'))
    <div class="ui warning message">
        <i class="close icon"></i>
        <i class="warning sign icon"></i>
        {{session('mensaje_advertencia')}}
    </div>
@elseif(session('mensaje_error'))
    <div class="ui error message">
        <i class="close icon"></i>
        <i class="warning circle icon"></i>
        {{session('mensaje_error')}}
    </div>
@elseif(session('mensaje_info'))
    <div class="ui info message">
        <i class="close icon"></i>
        <i class="info circle icon"></i>
        {{session('mensaje_info')}}
    </div>
@elseif(session('status'))
    <div class="ui success message">
        <i class="close icon"></i>
        <i class="check circle icon"></i>
        {{session('status')}}
    </div>
@elseif(count($errors) > 0)
    <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
            @lang('passwords.errors_header')
        </div>
        <ul class="list">
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif