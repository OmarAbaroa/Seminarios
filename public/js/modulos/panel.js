function editarCampo(id_campo){
    $('#' + id_campo).val($('#' + id_campo + '_txt').text().trim());
    $('#' + id_campo + '_txt').hide();
    $('#' + id_campo + '_input').show();
    $('#' + id_campo + '_bt_editar').hide();
    $('#' + id_campo + '_bt_cancelar').show();
}

function cancelarEditarCampo(id_campo){
    $('#' + id_campo + '_input').hide();
    $('#' + id_campo + '_txt').show();
    $('#' + id_campo + '_bt_cancelar').hide();
    $('#' + id_campo + '_bt_editar').show();
}

function actualizarNombre()
{
    if($('#usuario_input').form('is valid')){
        var tooltip = $('#usuario_boton').attr('data-tooltip');
        $('#usuario_boton').addClass('loading');
        $('#usuario_boton').prop('disabled', true);
        $('#usuario_boton').removeAttr('data-tooltip');

        $.ajax({
            type:'POST',
            url: '/actualizar-usuario',
            data: {
                '_method': 'patch',
                'nombre': $('#usuario').val()
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data.tipo == MENSAJE_EXITO){
                $('#usuario_txt').text(data.nombre);
                cancelarEditarCampo('usuario');
            }
            mostrarMensaje(data.mensaje, data.tipo);
        }).fail(function(){
            mostrarMensaje(ERROR_CONEXION, MENSAJE_ERROR);
        }).always(function(){
            $('#usuario_boton').removeClass('loading');
            $('#usuario_boton').prop('disabled', false);
            $('#usuario_boton').attr('data-tooltip', tooltip);
        });
    }else{
        mostrarMensaje(ERROR_FORM, MENSAJE_ERROR);
    }
}

function actualizarCorreo()
{
    if($('#email_input').form('is valid')){
        var tooltip = $('#email_boton').attr('data-tooltip');
        $('#email_boton').addClass('loading');
        $('#email_boton').prop('disabled', true);
        $('#email_boton').removeAttr('data-tooltip');

        $.ajax({
            type:'POST',
            url: '/actualizar-email',
            data: {
                '_method': 'patch',
                'email': $('#email').val()
            },
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data.tipo == MENSAJE_EXITO){
                $('#email_txt').text(data.email);
                cancelarEditarCampo('email');
            }
            mostrarMensaje(data.mensaje, data.tipo);
        }).fail(function(){
            mostrarMensaje(ERROR_CONEXION, MENSAJE_ERROR);
        }).always(function(){
            $('#email_boton').removeClass('loading');
            $('#email_boton').prop('disabled', false);
            $('#email_boton').attr('data-tooltip', tooltip);
        });
    }else{
        mostrarMensaje(ERROR_FORM, MENSAJE_ERROR);
    }
}

function cambiarContrasena(){
    if($('#form_contrasena').form('is valid')){
        $('#cambiar_contrasena .dimmer').addClass('active');

        $.ajax({
            type:'POST',
            url: '/actualizar-contrasena',
            data: $('#form_contrasena').serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data.tipo == MENSAJE_EXITO){
                cerrarModal('cambiar_contrasena');
                $('#form_contrasena').form('reset');
            }
            mostrarMensaje(data.mensaje, data.tipo);
        }).fail(function(){
            mostrarMensaje(ERROR_CONEXION, MENSAJE_ERROR);
        }).always(function(){
            $('#cambiar_contrasena .dimmer').removeClass('active');
        });
    }
    return false;
}

$('#usuario_input').form({
    on: 'blur',
    fields: {
        usuario: {
            identifier: 'usuario',
            rules: [
                {
                    type: 'empty'
                }
            ]
        },
    }
});

$('#email_input').form({
    on: 'blur',
    fields: {
        email: {
            identifier: 'email',
            rules: [
                {
                    type: 'empty',
                },
                {
                    type: 'regExp[' + PATRON_EMAIL + ']',
                }
            ]
        },
    }
});

$('#form_contrasena').form({
    on: 'blur',
    fields: {
        password: {
            identifier: 'password',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese su contraseña actual.'
                }
            ]
        },
        nueva_password: {
            identifier: 'nueva_password',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese una contraseña nueva.'
                },
                {
                    type: 'minLength[8]',
                    prompt: 'Por favor, ingrese una contraseña nueva con al menos 8 caracteres.'
                }
            ]
        },
        confirmar_nueva_password: {
            identifier: 'confirmar_nueva_password',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese la confirmación de contraseña.'
                },
                {
                    type: 'match[nueva_password]',
                    prompt: 'La confirmación de contraseña debe ser igual a la contraseña nueva.'
                }
            ]
        },
    }
});