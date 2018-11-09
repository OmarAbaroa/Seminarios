$('#form_director').form({
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
        cargo: {
            identifier: 'cargo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un cargo.'
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
        
    }
});