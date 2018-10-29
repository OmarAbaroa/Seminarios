<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ControladorUsuario@inicio')->name('inicio');
Route::post('/', 'ControladorUsuario@ingresar');
Route::get('/', 'ControladorUsuario@inicio')->name('login');

Route::group(['middleware' => ['auth']], function()
    {
        Route::get('/panel', 'ControladorUsuario@verPanel')->name('panel');
        Route::patch('/actualizar-usuario', 'ControladorUsuario@actualizarUsuario');
        Route::patch('/actualizar-email', 'ControladorUsuario@actualizarEmail');
        Route::patch('/actualizar-contrasena', 'ControladorUsuario@actualizarContrasena');
        Route::post('/salir', 'ControladorUsuario@salir');

        Route::get('/usuarios', 'ControladorUsuario@verTodos')->name('usuarios');
        Route::get('/usuarios/crear', 'ControladorUsuario@crear')->name('crear_usuario');
        Route::post('/usuarios/crear', 'ControladorUsuario@almacenar');
        Route::get('/usuarios/editar/{id}', 'ControladorUsuario@editar')->name('editar_usuario');
        Route::put('/usuarios/editar/{id}', 'ControladorUsuario@actualizar');
        Route::delete('/usuarios/eliminar/{id}', 'ControladorUsuario@eliminar')->name('eliminar_usuario');

        Route::get('/catalogos', 'ControladorUsuario@verCatalogos')->name('catalogos');

        Route::get('/catalogos/sexos', 'ControladorSexo@verTodos')->name('sexos');
        Route::get('/catalogos/sexos/crear', 'ControladorSexo@crear')->name('crear_sexo');
        Route::post('/catalogos/sexos/crear', 'ControladorSexo@almacenar');
        Route::get('/catalogos/sexos/editar/{id}', 'ControladorSexo@editar')->name('editar_sexo');
        Route::put('/catalogos/sexos/editar/{id}', 'ControladorSexo@actualizar');
        Route::delete('/catalogos/sexos/eliminar/{id}', 'ControladorSexo@eliminar')->name('eliminar_sexo');

        
        Route::get('/catalogos/areas', 'ControladorArea@verTodas')->name('areas');
        Route::get('/catalogos/areas/crear', 'ControladorArea@crear')->name('crear_area');
        Route::post('/catalogos/areas/crear', 'ControladorArea@almacenar');
        Route::get('/catalogos/areas/editar/{id}', 'ControladorArea@editar')->name('editar_area');
        Route::put('/catalogos/areas/editar/{id}', 'ControladorArea@actualizar');
        Route::delete('/catalogos/areas/eliminar/{id}', 'ControladorArea@eliminar')->name('eliminar_area');

        Route::get('/catalogos/unidades-academicas', 'ControladorUnidadAcademica@verTodas')->name('unidades_academicas');
        Route::get('/catalogos/unidades-academicas/crear', 'ControladorUnidadAcademica@crear')->name('crear_unidad_academica');
        Route::post('/catalogos/unidades-academicas/crear', 'ControladorUnidadAcademica@almacenar');
        Route::get('/catalogos/unidades-academicas/editar/{id}', 'ControladorUnidadAcademica@editar')->name('editar_unidad_academica');
        Route::put('/catalogos/unidades-academicas/editar/{id}', 'ControladorUnidadAcademica@actualizar');
        Route::delete('/catalogos/unidades-academicas/eliminar/{id}', 'ControladorUnidadAcademica@eliminar')->name('eliminar_unidad_academica');

        Route::get('/catalogos/unidades-academicas/programas-academicos/{id_unidad_academica}', 'ControladorUnidadAcademicaProgramaAcademico@verTodos')->name('unidades_academicas_programas_academicos');
        Route::post('/catalogos/unidades-academicas/programas-academicos/crear', 'ControladorUnidadAcademicaProgramaAcademico@almacenar')->name('almacenar_unidad_academica_programa_academico');
        Route::delete('/catalogos/unidades-academicas/programas-academicos/eliminar/{id}', 'ControladorUnidadAcademicaProgramaAcademico@eliminar')->name('eliminar_unidad_academica_programa_academico');

        Route::get('/catalogos/programas-academicos', 'ControladorProgramaAcademico@verTodos')->name('programas_academicos');
        Route::get('/catalogos/programas-academicos/crear', 'ControladorProgramaAcademico@crear')->name('crear_programa_academico');
        Route::post('/catalogos/programas-academicos/crear', 'ControladorProgramaAcademico@almacenar');
        Route::get('/catalogos/programas-academicos/editar/{id}', 'ControladorProgramaAcademico@editar')->name('editar_programa_academico');
        Route::put('/catalogos/programas-academicos/editar/{id}', 'ControladorProgramaAcademico@actualizar');
        Route::delete('/catalogos/programas-academicos/eliminar/{id}', 'ControladorProgramaAcademico@eliminar')->name('eliminar_programa_academico');

        Route::get('/catalogos/escolaridad', 'ControladorEscolaridad@verTodos')->name('escolaridades');
        Route::get('/catalogos/escolaridad/crear', 'ControladorEscolaridad@crear')->name('crear_escolaridad');
        Route::post('/catalogos/escolaridad/crear', 'ControladorEscolaridad@almacenar');
        Route::get('/catalogos/escolaridad/editar/{id}', 'ControladorEscolaridad@editar')->name('editar_escolaridad');
        Route::put('/catalogos/escolaridad/editar/{id}', 'ControladorEscolaridad@actualizar');
        Route::delete('/catalogos/escolaridad/eliminar/{id}', 'ControladorEscolaridad@eliminar')->name('eliminar_escolaridad');

        Route::get('/catalogos/funcionario', 'ControladorFuncionario@verTodos')->name('funcionarios');
        Route::get('/catalogos/funcionario/crear', 'ControladorFuncionario@crear')->name('crear_funcionario');
        Route::post('/catalogos/funcionario/crear', 'ControladorFuncionario@almacenar');
        Route::get('/catalogos/funcionario/editar/{id}', 'ControladorFuncionario@editar')->name('editar_funcionario');
        Route::put('/catalogos/funcionario/editar/{id}', 'ControladorFuncionario@actualizar');
        Route::delete('/catalogos/funcionario/eliminar/{id}', 'ControladorFuncionario@eliminar')->name('eliminar_funcionario');

        Route::get('/catalogos/director', 'ControladorDirector@verTodos')->name('directores');
        Route::get('/catalogos/director/crear', 'ControladorDirector@crear')->name('crear_director');
        Route::post('/catalogos/director/crear', 'ControladorDirector@almacenar');
        Route::get('/catalogos/director/editar/{id}', 'ControladorDirector@editar')->name('editar_director');
        Route::put('/catalogos/director/editar/{id}', 'ControladorDirector@actualizar');
        Route::delete('/catalogos/director/eliminar/{id}', 'ControladorDirector@eliminar')->name('eliminar_director');

        Route::get('/seminarios', 'ControladorSeminario@verTodos')->name('seminarios');
        Route::get('/seminarios/cargar', 'ControladorSeminario@cargar')->name('cargar_seminario');
        Route::post('/seminarios/cargar', 'ControladorSeminario@almacenar');
        Route::patch('/seminario/respuesta/{id}', 'ControladorSeminario@generarRespuesta')->name('generar_respuesta');

        Route::get('/seminarios/editar/{id}{impartir}', 'ControladorSeminario@editar')->name('editar_seminario');
        Route::put('/seminarios/editar/{id}{impartir}', 'ControladorSeminario@actualizar');
        Route::get('/seminarios/memorandum/{id}', 'ControladorSeminario@generarMemorandum')->name('generar_memorandum');
        Route::get('/seminarios/limpiar/{id}', 'ControladorSeminario@limpiarSeminario')->name('limpiar_seminario');
        Route::get('/seminarios/editar/lista-inicial/{id}', 'ControladorSeminario@entregoListaInicial')->name('lista_inicial');
        Route::delete('/seminarios/eliminar/{id}', 'ControladorSeminario@eliminar')->name('eliminar_seminario');
        Route::get('/seminarios/impartir', 'ControladorSeminario@verImpartir')->name('impartir_seminario');
        Route::get('/seminarios/impartir/{id}', 'ControladorSeminario@impartir')->name('impartir_seminario_id');
        Route::put('/seminarios/impartir/{id}', 'ControladorSeminario@impartirSeminario');
        Route::get('/seminarios/buscar', 'ControladorSeminario@buscar')->name('buscar_seminarios');
        Route::get('seminarios/constancias/{id}', 'ControladorSeminario@verGenerarConstancias')->name('generar_constancia');
        Route::post('seminarios/constancias/{id}', 'ControladorSeminario@generarConstancias');
        
        Route::patch('/seminario/cargar-horario', 'ControladorHorario@cargar');
        Route::delete('/seminario/horario/eliminar/{id}', 'ControladorHorario@eliminar')->name('eliminar_horario');

        Route::get('/alumnos', 'ControladorAlumno@verCargarAlumno')->name('cargar_alumno');
        Route::post('/alumnos', 'ControladorAlumno@cargarAlumno');

        Route::get('/expositores', 'ControladorExpositor@verCargarExpositor')->name('cargar_expositor');
        Route::post('/expositores', 'ControladorExpositor@cargarExpositor');

        Route::delete('/seminario/expositor/{id}', 'ControladorSeminarioExpositor@eliminar')->name('eliminar_seminario_expositor');
        Route::delete('/seminario/alumno/{id}', 'ControladorSeminarioAlumno@eliminar')->name('eliminar_seminario_alumno');
        Route::get('/seminario/alumnos/{id}', 'ControladorSeminarioAlumno@eliminarTodos')->name('eliminar_todos_alumnos');
        Route::get('/seminario/expositores/{id}', 'ControladorSeminarioExpositor@eliminarTodos')->name('eliminar_todos_expositores');

        Route::get('/reportes','ControladorSeminario@verReportes')->name('reportes');
        Route::post('/reportes/trimestre', 'ControladorSeminario@reporteTrimestre')->name('reporte_trimestre');
        Route::post('/reportes/ua', 'ControladorSeminario@reporteUA')->name('reporte_vigentes_ua');
    }
);
