$('#form_restablecer').form({
    on: 'blur',
    fields: {
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
                    prompt: 'Por favor, ingrese una contraseña nueva.'
                },
                {
                    type: 'minLength[8]',
                    prompt: 'Por favor, ingrese una contraseña nueva con al menos 8 caracteres.'
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
                    prompt: 'La confirmación de contraseña debe ser igual a la contraseña nueva.'
                }
            ]
        },
    }
});