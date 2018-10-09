$('#form_funcionario').form({
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
        apellidos: {
            identifier: 'apellidos',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese los apellidos.'
                }
            ]
        },
        cargo: {
            identifier: 'cargo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese el cargo.'
                }
            ]
        },
        escolaridad: {
            identifier: 'escolaridad',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione la escolaridad.'
                }
            ]
        },
        sexo: {
            identifier: 'sexo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione el sexo.'
                }
            ]
        },

    }
});