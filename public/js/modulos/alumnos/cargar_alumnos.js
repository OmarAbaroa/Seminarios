$('#form_cargar_alumnos').form({
    on: 'blur',
    fields: {
        intervalo: {
            identifier: 'intervalo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese el o los intervalos de alumnos a cargar.'
                },
                {
                    type: 'regExp[' + PATRON_INTERVALOS + ']',
                    prompt: 'Por favor, ingrese uno o más intervalos válidos.'
                }
            ]
        },
        archivo: {
            identifier: 'archivo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione un archivo.'
                }
            ]
        },
    }
});

