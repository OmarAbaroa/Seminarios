<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        @if(Session::has('download.in.the.next.request'))
             <meta http-equiv="refresh" content="0;url={{ Session::get('download.in.the.next.request') }}">
        @endif
        <title>COSIE - SICOSE | @yield('titulo')</title>

        <link rel="stylesheet" href="/css/semantic.min.css">
        <link rel="stylesheet" href="/css/icon.min.css">
        <link rel="stylesheet" href="/css/calendar.min.css">
        <link rel="stylesheet" href="/css/app.css">
        @stack('css')
    </head>
    <body>
        <div id="menu" class="ui left fixed vertical inverted sidebar menu">
            <a class="item" href="/">
                <img class="ui mini image centered" src="/img/logoIPN.png">
                <strong>Sistema de Control de Seminarios</strong>
            </a>
            @include('menu')
        </div>
        <div class="cuerpo pusher">
            <header>
                <div id="barra_superior" class="ui top fixed inverted labeled icon stackable menu">
                    <a class="item" href="/">
                        <img src="/img/logoIPN.png">
                        <strong>Sistema de Control de Seminarios</strong>
                    </a>
                    <a id="boton_menu" class="item">
                        <i class="content icon"></i>
                        Menú
                    </a>
                </div>
            </header>

            <main>
                <div id="contenido" class="ui container contenido">
                    @include("mensajes")
                    <div class="ui warning message">
                        <i class="warning sign icon"></i>
                        Se encuentra en la versión local
                    </div>
                    @yield("contenido")
                    <div class="ui page dimmer">
                        <div class="ui text loader">Espere un momento</div>
                    </div>
                </div>
                <div id="contenedor_mensajes_emergentes"></div>

                <script src="/js/jquery-3.2.1.min.js"></script>
                <script src="/js/semantic.min.js"></script>
                <script src="/js/calendar.min.js"></script>
                <script src="/js/app.js"></script>
                @stack('js')
            </main>
        
            <footer>
                <div class="ui black inverted vertical footer segment">
                    <div class="ui container">
                        Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor,
                        puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite
                        la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización
                        previa y por escrito del Director General del Instituto. ®2017
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>