$('#form_editar_seminario').form({
    on: 'blur',
    fields: {
        nombre: {
            identifier: 'nombre',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un nombre para el seminario.'
                }
            ]
        },
        tipo_seminario: {
            identifier: 'tipo_seminario',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, el tipo del seminario.'
                }
            ]
        },
        unidad_academica: {
            identifier: 'unidad_academica',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione la unidad académica.'
                }
            ]
        },
        duracion: {
            identifier: 'duracion',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese la duración del seminario.'
                }
            ]
        },
    }
});