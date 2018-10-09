const margen_superior = 10;

const PATRON_EMAIL = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/';
const PATRON_INTERVALOS = '/^(([0-9]+|[0-9]+ *?- *?[0-9]+) *?,? *?)+$/';

const MENSAJE_EXITO = 'success';
const MENSAJE_ADVERTENCIA = 'warning';
const MENSAJE_ERROR = 'error';
const MENSAJE_INFO = 'info';

const ERROR_CONEXION = 'Fallo en la conexión, inténtelo nuevamente.';
const ERROR = 'Ha ocurrido un error, inténtelo nuevamente.';
const ERROR_FORM = 'Verifique que los datos sean correctos.';

$(document).ready(function(){
    
    $('#boton_menu').click(function(){
        $('#menu').sidebar('setting', 'transition', 'overlay').sidebar('toggle');
    });

    ajustarMargenSuperior();
    $(window).resize(ajustarMargenSuperior);

    $('.message .close').on('click', function(){
        $(this).closest('.message').transition('fade');
    });

    $('.cargar').on('click', function(){
        if($(this).closest('form').form('is valid') || $(this).hasClass('cancelar')){
            $('#contenido .dimmer').addClass('active');
        }
    });

    $.each($('input:file'), function(i, v){
        $('#' + v.id + '_boton').on('click', function(){
            $(v).click();
        });
        $(v).on('change', function(){
            $('#' + v.id + '_txt').val($(v).val().split('\\').pop());
        });
    });

    $('.ui.accordion').accordion();
    $('select.dropdown').dropdown({ fullTextSearch: "exact" });
    $('.calendario').calendar({
        type: 'date',
        text: {
            days: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            today: 'Hoy',
            now: 'Ahora',
            am: 'AM',
            pm: 'PM'
        },
        formatter: {
            date: function (date, settings) {
                if (!date) {
                    return '';
                }
                var day = date.getDate() + '';
                if (day.length < 2) {
                    day = '0' + day;
                }

                var month = (date.getMonth() + 1) + '';
                if (month.length < 2) {
                    month = '0' + month;
                }

                var year = date.getFullYear();

                return day + '/' + month + '/' + year;
            },
        },
        parser: {
            date: function (text, settings) {
                var elements = text.split('/');
                var date = new Date();
                if(elements.length >= 3)
                {
                    date.setFullYear(elements[2]);
                }
                if(elements.length >= 2)
                {
                    date.setMonth(elements[1] - 1);
                }
                if(elements.length >= 1)
                {
                    date.setDate(elements[0]);
                }
                return date;
            }
        },
        popupOptions: {
            observeChanges: false,
        },
    });
});

function ajustarMargenSuperior(){
    var altura_barra_superior = $('#barra_superior').height();
    $('#contenido').css('margin-top', altura_barra_superior + margen_superior);
}

function salir(){
    $.ajax({
        type:'POST',
        url: '/salir',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(data){
        window.location.replace('/');
    }).fail(function(){
        abrirModal('error_salir');
    });
}

function mostrarMensaje(mensaje, tipo = MENSAJE_INFO, tiempo = 3000){
    var icono = '';
    if(tipo == MENSAJE_EXITO){
        icono = 'check circle';
    }else if(tipo == MENSAJE_ADVERTENCIA){
        icono = 'warning sign';
    }else if(tipo == MENSAJE_ERROR){
        icono = 'warning circle';
    }else{
        icono = 'info circle';
    }

    $('<div>', {
        'class': 'ui ' + tipo + ' message',
    }).append($('<i>', {
        'class': icono + ' icon',
    })).append(mensaje)
    .hide()
    .appendTo('#contenedor_mensajes_emergentes')
    .transition('fade up')
    .transition({
        animation: 'fade up',
        interval: tiempo
    });
}

function abrirModal(id_modal, $bloquear = true){
    $('#' + id_modal).modal('setting', 'closable', !$bloquear).modal('show');
}

function cerrarModal(id_modal){
    $('#' + id_modal).modal('hide');
    $('#' + id_modal).removeClass('active');
}

function abrirCarga(id = 'contenido')
{
    $('#' + id + ' .dimmer').addClass('active');
}

function cerrarCarga(id = 'contenido')
{
    $('#' + id + ' .dimmer').removeClass('active');
}

function enviarForm(id_form){
    $('#' + id_form).submit();
}

function redireccionar(url){
    $(location).attr('href', url);
}

function abrirVentana(url){
    window.open(url, '_blank');
}