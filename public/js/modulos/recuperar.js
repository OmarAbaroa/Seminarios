$('#form_recuperar').form({
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
    }
});