$('#form_area').form({
    on: 'blur',
    fields: {
        nombre: {
            identifier: 'nombre',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un nombre.'
                }
            ]
        },
    }
});