@extends('plantilla')

@section('titulo', 'Panel')

@push('js')
    <script src="/js/modulos/panel.js"></script>
@endpush

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Panel</h1>
    </div>
    <br/>
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th colspan="3">
                    Datos de usuario
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <b>Nombre de usuario</b>
                </td>
                <td>
                    <div id="usuario_txt">
                        {{$usuario->nombre}}
                    </div>
                    <div id="usuario_input" class="oculto">
                        
                        @include('elementos_html.input',[
                            'id' => 'usuario',
                            'nombre' => 'usuario',
                            'etiqueta' => 'Nombre de usuario',
                            'actual' => $usuario->nombre,
                            'accion' => '',
                            'class_boton' => 'primary right',
                            'icono_boton' => 'save',
                            'popup_boton' => 'Guardar',
                            'onclick_boton' => 'actualizarNombre()'
                        ])
                    </div>
                </td>
                <td>
                    <div id="usuario_bt_editar">
                        @include('elementos_html.button', [
                            'class' => 'primary',
                            'icono' => 'edit',
                            'onclick' => 'editarCampo("usuario")',
                            'popup' => 'Editar'
                        ])
                    </div>
                    <div id="usuario_bt_cancelar" class="oculto">
                        @include('elementos_html.button', [
                            'class' => 'red',
                            'icono' => 'cancel',
                            'onclick' => 'cancelarEditarCampo("usuario")',
                            'popup' => 'Cancelar'
                        ])
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Correo electrónico</b>
                </td>
                <td>
                    <div id="email_txt">
                        {{$usuario->email}}
                    </div>
                    <div id="email_input" class="oculto">
                        @include('elementos_html.input',[
                            'id' => 'email',
                            'nombre' => 'email',
                            'etiqueta' => 'Correo electrónico',
                            'actual' => $usuario->email,
                            'accion' => '',
                            'class_boton' => 'primary right',
                            'icono_boton' => 'save',
                            'popup_boton' => 'Guardar',
                            'onclick_boton' => 'actualizarCorreo()'
                        ])
                    </div>
                </td>
                <td>
                    <div id="email_bt_editar">
                        @include('elementos_html.button', [
                            'class' => 'primary',
                            'icono' => 'edit',
                            'onclick' => 'editarCampo("email")',
                            'popup' => 'Editar'
                        ])
                    </div>
                    <div id="email_bt_cancelar" class="oculto">
                        @include('elementos_html.button', [
                            'class' => 'red',
                            'icono' => 'cancel',
                            'onclick' => 'cancelarEditarCampo("email")',
                            'popup' => 'Cancelar'
                        ])
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <b>Contraseña</b>
                </td>
                <td colspan="2">
                    <a onclick="abrirModal('cambiar_contrasena')" href="#">CAMBIAR</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div id="cambiar_contrasena" class="ui modal">
        <div class="header">Cambiar contraseña</div>
        <div class="content">
            <form id="form_contrasena" class="ui form" onsubmit="return cambiarContrasena()">
                {{method_field('patch')}}
                @include('elementos_html.input_field', [
                    'id' => 'password',
                    'nombre' => 'password',
                    'tipo' => 'password',
                    'etiqueta' => 'Contraseña actual',
                    'placeholder' => 'Contraseña actual',
                    'class' => 'required'
                ])
                @include('elementos_html.input_field', [
                    'id' => 'nueva_password',
                    'nombre' => 'nueva_password',
                    'tipo' => 'password',
                    'etiqueta' => 'Contraseña nueva',
                    'placeholder' => 'Contraseña nueva',
                    'class' => 'required'
                ])
                @include('elementos_html.input_field', [
                    'id' => 'confirmar_nueva_password',
                    'nombre' => 'confirmar_nueva_password',
                    'tipo' => 'password',
                    'etiqueta' => 'Confirmar contraseña nueva',
                    'placeholder' => 'Confirmar contraseña nueva',
                    'class' => 'required'
                ])
                <div class="ui error message"></div>
            </form>
        </div>
        <div class="actions">
            @include('elementos_html.button', [
                'class' => 'green',
                'etiqueta' => 'Guardar',
                'onclick' => 'enviarForm("form_contrasena")'
            ])
            <div class="ui red cancel button">Cancelar</div>
        </div>
        <div class="ui inverted dimmer">
            <div class="ui text loader">Espere un momento</div>
        </div>
    </div>
    <table class="ui celled striped table">
        <thead>
            <tr>
                <th>
                    Seminarios faltantes de entregar lista inicial (20 días hábiles superados)
                </th>
                <th>
                    Unidad Académica
                </th>
                <th>
                    Acción
                </th>
            </tr>
        </thead>
    <?php 
        Use App\AvisoSeminario;
        $avisos = AvisoSeminario::where('fecha_entrega_lista_inicial', '<=', date("Y-m-d"))->get();
    ?>    
        @foreach($avisos as $aviso)
            @if(date("Y-m-d") > $aviso->fecha_entrega_lista_oficial )
                
                <tr>
                    <td>
                        {{$aviso->seminario->nombre}}
                    </td>
                    <td>
                        {{$aviso->seminario->unidadAcademica->siglas}}
                    </td>
                    <td>
                        @include('elementos_html.button', [
                            'class' => 'red margen-boton-accion',
                            'icono' => 'pencil alternate',
                            'popup' => 'Lista inicial',
                            'onclick' => 'redireccionar("' . route('lista_inicial', ['id' => $aviso->seminario->id]) . '")'
                        ])
                    </td>
                </tr>
            @endif
        @endforeach
    
    </table>
@endsection