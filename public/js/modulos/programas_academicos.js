$('#form_agregar_programa_academico').form({
    on: 'blur',
    fields: {
        programa_academico: {
            identifier: 'programa_academico',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, seleccione un Programa Académico.'
                }
            ]
        },
    }
});

function agregarProgramaAcademico(){
    if($('#form_agregar_programa_academico').form('is valid')){
        $('#agregar_programa_academico .dimmer').addClass('active');
        return true;
    }
    return false;
}