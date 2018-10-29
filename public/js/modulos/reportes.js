$('#form_reporte_trimestre').form({
    on: 'blur',
    fields: {
        anio: {
            identifier: 'anio',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un Año.'
                }
            ]
        },

        trimestre: {
            identifier: 'trimestre',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione un trimestre.'
                }
            ]
        },
        analista1: {
            identifier: 'analista1',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese al menos un analista.'
                }
            ]
        },
    }
});