$('#form_cargar_horario').form({
    on: 'blur',
    fields: {
        dia: {
            identifier: 'dia',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un día.'
                }
            ]
        },
        hora_inicio: {
            identifier: 'hora_inicio',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese la hora de inicio.'
                }
            ]
        },
        hora_final: {
            identifier: 'hora_final',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese la hora de termino.'
                }
            ]
        },
        
    }
});

function cargarHorario(){
    if($('#form_cargar_horario').form('is valid')){
        $('#cargar_horario .dimmer').addClass('active');

        $.ajax({
            type:'POST',
            url: '/seminario/cargar-horario',
            data: $('#form_cargar_horario').serialize(),
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function(data){
            if(data.tipo == MENSAJE_EXITO){
                cerrarModal('cargar_horario');
                $('#form_cargar_horario').form('reset');
            }
            mostrarMensaje(data.mensaje, data.tipo);
            location.reload();
        }).fail(function(){
            mostrarMensaje(ERROR_CONEXION, MENSAJE_ERROR);
        }).always(function(){
            $('#cargar_horario .dimmer').removeClass('active');
        });
    }
    return false;
}