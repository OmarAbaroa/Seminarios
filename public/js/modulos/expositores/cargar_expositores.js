$('#form_cargar_expositores').form({
    on: 'blur',
    fields: {
        intervalo: {
            identifier: 'intervalo',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese el o los intervalos de expositores a cargar.'
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
        seminario: {
            identifier: 'seminario',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Por favor, ingrese un seminario.'
                }
            ]
        },
    }
});

$(document).ready(function(){
    $('#seminario').closest('.search').search({
        apiSettings: {
            url: '/seminarios/buscar?seminario={seminario}',
            beforeSend: function(settings) {
                settings.urlData = {
                    seminario: $('#seminario').val()
                };
                return settings;
            }
        },
        type: 'category',
        cache: false,
        maxResults: 10,
        onSelect: function(result, response){
            $('#seminario').val(result.id);
            
        },
        onResultsClose: function() {
            if($('#seminario').val() == '')
            {
                $('#seminario').val('');
            }
        },
    });
    
});
