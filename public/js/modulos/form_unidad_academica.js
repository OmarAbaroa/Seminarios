$('#form_unidad_academica').form({
    on: 'blur',
    fields: {
        nombre: {
            identifier: 'siglas',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un acrónimo.'
                }
            ]
        },
        nombre_completo: {
            identifier: 'nombre',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un nombre.'
                }
            ]
        },
        clave: {
            identifier: 'clave',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese una clave.'
                }
            ]
        },
        area: {
            identifier: 'area',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione un área.'
                }
            ]
        },
    }
});