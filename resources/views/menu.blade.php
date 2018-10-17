@if(!Auth::check())
    <a class="item" href="buscar_seminarios">
        <i class="search icon"></i>
        Buscar seminarios
    </a>
    <a class="item" href="ingreso">
        <i class="sign in icon"></i>
        Ingresar
    </a>
@else
    
    <a class="item" href="{{route('panel')}}">
        <i class="user icon"></i>
        Panel
    </a>
    @if(Auth::user()->esTipo(env('USUARIO_ADMIN')))
        <a class="item" href="{{route('usuarios')}}">
            <i class="users icon"></i>
            Usuarios
        </a>
        <a class="item" href="{{route('catalogos')}}">
            <i class="list layout icon"></i>
            Administrar catálogos
        </a>
    @endif
    <a class="item" href="{{route('cargar_seminario')}}">
        <i class="upload icon"></i>
        Cargar seminario
    </a>
    
    <a class="item" href="{{route('seminarios')}}">
        <i class="search icon"></i>
        Buscar seminarios
    </a>
    <a class="item" href="{{route('impartir_seminario')}}">
        <i class="play icon"></i>
        Impartir seminario
    </a>
    <a class="item" href="{{route('cargar_alumno')}}">
        <i class="cloud upload icon"></i>
        Cargar alumnos
    </a>
    <a class="item" href="{{route('cargar_expositor')}}">
        <i class="cloud upload icon"></i>
        Cargar expositores
    </a>
    <a class="item" onclick="salir()">
        <i class="sign out icon"></i>
        Salir
    </a>
    <div id="error_salir" class="ui basic modal">
        <div class="ui icon header">
            <div class="ui center aligned container">
                <i class="warning circle icon"></i>
                ERROR
            </div>
        </div>
        <div class="content">
            <div class="ui center aligned container">
                <p>@lang('mensajes.sesion.error.salir')</p>
            </div>
        </div>
        <div class="actions">
            <div class="ui center aligned container">
                <div class="ui blue ok inverted button">
                    Aceptar
                </div>
            </div>
        </div>
    </div>
@endif
