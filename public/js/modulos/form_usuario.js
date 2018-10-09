$('#form_usuario').form({
    on: 'blur',
    fields: {
        tipo_usuario: {
            identifier: 'tipo_usuario',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione un tipo de usuario.'
                }
            ]
        },
        usuario: {
            identifier: 'usuario',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un nombre de usuario.'
                }
            ]
        },
        email: {
            identifier: 'email',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un correo electrónico.'
                },
                {
                    type: 'regExp[' + PATRON_EMAIL + ']',
                    prompt: 'Por favor, ingrese un correo electrónico válido.'
                }
            ]
        },
        password: {
            identifier: 'password',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese una contraseña.'
                },
                {
                    type: 'minLength[8]',
                    prompt: 'Por favor, ingrese una contraseña con al menos 8 caracteres.'
                }
            ]
        },
        password_confirmation: {
            identifier: 'password_confirmation',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese la confirmación de contraseña.'
                },
                {
                    type: 'match[password]',
                    prompt: 'La confirmación de contraseña debe ser igual a la contraseña.'
                }
            ]
        },
    }
});