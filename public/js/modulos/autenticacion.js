$('#form_autenticacion').form({
    on: 'blur',
    fields: {
        usuario: {
            identifier: 'usuario',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un usuario.'
                }
            ]
        },
        password: {
            identifier: 'password',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese una contraseña.'
                }
            ]
        },
    }
});