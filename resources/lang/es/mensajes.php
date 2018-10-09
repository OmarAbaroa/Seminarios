<?php

return [
    
    'sesion' => [
        'error' => [
            'salir' => 'No ha sido posible cerrar la sesión, inténtelo nuevamente.',
        ],
    ],

    'panel' => [
        'exito' => [
            'actualizar_nombre' => 'El nombre de usuario ha sido actualizado correctamente.',
            'actualizar_email' => 'El correo electrónico ha sido actualizado correctamente.',
            'actualizar_contrasena' => 'La contraseña ha sido actualizada correctamente.',
        ],
        'advertencia' => [
            'actualizar_nombre' => 'El nombre de usuario ingresado se encuentra en uso.',
            'actualizar_email' => 'El correo electrónico ingresado se encuentra en uso.',
        ],
        'error' => [
            'actualizar_contrasena' => 'La contraseña actual ingresada no corresponde a su cuenta.',
        ],
    ],

    'usuarios' => [
        'exito' => [
            'almacenar' => 'El usuario ha sido creado correctamente.',
            'actualizar' => 'El usuario ha sido guardado correctamente.',
            'eliminar' => 'El usuario ha sido eliminado correctamente.',
        ],
        'error' => [
            'existe_usuario' => 'El nombre de usuario ingresado se encuentra en uso.',
            'existe_email' => 'El correo electrónico ingresado se encuentra en uso.',
            'editar' => 'Ha ocurrido un error al tratar de editar el usuario, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el usuario, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el usuario, inténtelo nuevamente.',
        ],
    ],

    'archivos' => [
        'error' => [
            'archivo_muy_grande' => 'Archivo demasiado grande.',
            'formato_archivo_no_permitido' => 'Formato de archivo no permitido.',
        ]
        ],

    'sexos' => [
        'exito' => [
            'almacenar' => 'El sexo ha sido creado correctamente.',
            'actualizar' => 'El sexo ha sido guardado correctamente.',
            'eliminar' => 'El sexo ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el sexo, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el sexo, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el sexo, inténtelo nuevamente.',
        ],
    ],

    'cargos' => [
        'exito' => [
            'almacenar' => 'El cargo ha sido creado correctamente.',
            'actualizar' => 'El cargo ha sido guardado correctamente.',
            'eliminar' => 'El cargo ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el cargo, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el cargo, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el cargo, inténtelo nuevamente.',
        ],
    ],

    'escolaridades' => [
        'exito' => [
            'almacenar' => 'La escolaridad ha sido creado correctamente.',
            'actualizar' => 'La escolaridad ha sido guardado correctamente.',
            'eliminar' => 'La escolaridad ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar la escolaridad, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar la escolaridad, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar la escolaridad, inténtelo nuevamente.',
        ],
    ],

    'areas' => [
        'exito' => [
            'almacenar' => 'El área ha sido creada correctamente.',
            'actualizar' => 'El área ha sido guardada correctamente.',
            'eliminar' => 'El área ha sido eliminada correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el área, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el área, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el área, inténtelo nuevamente.',
        ],
    ],

    'funcionarios' => [
        'exito' => [
            'almacenar' => 'El funcionario ha sido creado correctamente.',
            'actualizar' => 'El funcionario ha sido guardado correctamente.',
            'eliminar' => 'El funcionario ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el funcionario, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el funcionario, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el funcionario, inténtelo nuevamente.',
        ],
    ],

    'directores' => [
        'exito' => [
            'almacenar' => 'El director ha sido creado correctamente.',
            'actualizar' => 'El director ha sido guardado correctamente.',
            'eliminar' => 'El director ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el director, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el director, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el director, inténtelo nuevamente.',
        ],
    ],

    'unidades_academicas' => [
        'exito' => [
            'almacenar' => 'La Unidad Académica ha sido creada correctamente.',
            'actualizar' => 'La Unidad Académica ha sido guardada correctamente.',
            'eliminar' => 'La Unidad Académica ha sido eliminada correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar la Unidad Académica, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar la Unidad Académica, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar la Unidad Académica, inténtelo nuevamente.',
            'clave_existe' => 'La clave ingresada ya existe.',
        ],
        'programas_academicos' => [
            'exito' => [
                'almacenar' => 'El Programa Académico ha sido agregado correctamente.',
                'eliminar' => 'El Programa Académico ha sido eliminado correctamente.',
            ],
            'error' => [
                'almacenar' => 'Ha ocurrido un error al tratar de agregar el Programa Académico, inténtelo nuevamente.',
                'eliminar' => 'Ha ocurrido un error al tratar de eliminar el Programa Académico, inténtelo nuevamente.',
                'existe' => 'El Programa Académico ya fue agregado anteriormente.',
            ],
        ],
    ],

    'programas_academicos' => [
        'exito' => [
            'almacenar' => 'El Programa Académico ha sido creado correctamente.',
            'actualizar' => 'El Programa Académico ha sido guardado correctamente.',
            'eliminar' => 'El Programa Académico ha sido eliminado correctamente.',
        ],
        'error' => [
            'editar' => 'Ha ocurrido un error al tratar de editar el Programa Académico, inténtelo nuevamente.',
            'actualizar' => 'Ha ocurrido un error al tratar de guardar el Programa Académico, inténtelo nuevamente.',
            'eliminar' => 'Ha ocurrido un error al tratar de eliminar el Programa Académico, inténtelo nuevamente.',
        ],
    ],

    'reportes' => [
        'error' => [
            'generar_sesion' => 'Ha ocurrido un error al tratar de generar los reportes por sesión, inténtelo nuevamente.',
            'generar_trimestre' => 'Ha ocurrido un error al tratar de generar los reportes por trimestre, inténtelo nuevamente.',
            'generar_listado' => 'Ha ocurrido un error al tratar de generar el listado de alumnos por sesión, inténtelo nuevamente.',
        ],
    ],
    
];
