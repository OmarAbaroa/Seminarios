<?php

use Illuminate\Database\Seeder;
use App\UnidadAcademica;

class UnidadAcademicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unidades_academicas = [
            [
                'id' => '1',
                'siglas' => 'ESIME Zacatenco',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD ZACATENCO.',
                'clave' => '30',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '2',
                'siglas' => 'ESIA Zacatenco',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA, UNIDAD ZACATENCO.',
                'clave' => '31',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '3',
                'siglas' => 'ESIQIE',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA QUÍMICA E INDUSTRIAS EXTRACTIVAS.',
                'clave' => '32',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '4',
                'siglas' => 'ESFM',
                'nombre' => 'ESCUELA SUPERIOR DE FÍSICA Y MATEMÁTICAS.',
                'clave' => '33',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '5',
                'siglas' => 'ESIT',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA TEXTIL.',
                'clave' => '34',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '6',
                'siglas' => 'ESIME Culhuacán',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD CULHUACÁN.',
                'clave' => '35',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '7',
                'siglas' => 'ESIME Azcapotzalco',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD AZCAPOTZALCO.',
                'clave' => '36',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '8',
                'siglas' => 'ESIME Ticomán',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA MECÁNICA Y ELÉCTRICA, UNIDAD TICOMÁN.',
                'clave' => '37',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '9',
                'siglas' => 'ESIA Tecamachalco',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA, UNIDAD TECAMACHALCO.',
                'clave' => '38',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '10',
                'siglas' => 'ESIA Ticomán',
                'nombre' => 'ESCUELA SUPERIOR DE INGENIERÍA Y ARQUITECTURA, UNIDAD TICOMÁN.',
                'clave' => '39',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '11',
                'siglas' => 'ESCA Santo Tomás',
                'nombre' => 'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN, UNIDAD SANTO TOMÁS.',
                'clave' => '40',
                'id_area' => env('AREA_CSA'),
            ],
            [
                'id' => '12',
                'siglas' => 'ESE',
                'nombre' => 'ESCUELA SUPERIOR DE ECONOMÍA.',
                'clave' => '41',
                'id_area' => env('AREA_CSA'),
            ],
            [
                'id' => '13',
                'siglas' => 'EST',
                'nombre' => 'ESCUELA SUPERIOR DE TURISMO.',
                'clave' => '42',
                'id_area' => env('AREA_CSA'),
            ],
            [
                'id' => '14',
                'siglas' => 'ESCA Tepepan',
                'nombre' => 'ESCUELA SUPERIOR DE COMERCIO Y ADMINISTRACIÓN, UNIDAD TEPEPAN.',
                'clave' => '43',
                'id_area' => env('AREA_CSA'),
            ],
            [
                'id' => '15',
                'siglas' => 'ENCB',
                'nombre' => 'ESCUELA NACIONAL DE CIENCIAS BIOLÓGICAS.',
                'clave' => '50',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '16',
                'siglas' => 'ESM',
                'nombre' => 'ESCUELA SUPERIOR DE MEDICINA.',
                'clave' => '51',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '17',
                'siglas' => 'ENMH',
                'nombre' => 'ESCUELA NACIONAL DE MEDICINA Y HOMEOPATÍA.',
                'clave' => '52',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '18',
                'siglas' => 'ESEO',
                'nombre' => 'ESCUELA SUPERIOR DE ENFERMERÍA Y OBSTETRICIA.',
                'clave' => '53',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '19',
                'siglas' => 'UPIICSA',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA Y CIENCIAS SOCIALES Y ADMINISTRATIVAS.',
                'clave' => '60',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '20',
                'siglas' => 'CICS Milpa Alta',
                'nombre' => 'CENTRO INTERDISCIPLINARIO DE CIENCIAS DE LA SALUD, UNIDAD MILPA  ALTA.',
                'clave' => '61',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '21',
                'siglas' => 'UPIBI',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE BIOTECNOLOGÍA.',
                'clave' => '62',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '22',
                'siglas' => 'ESCOM',
                'nombre' => 'ESCUELA SUPERIOR DE CÓMPUTO.',
                'clave' => '63',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '23',
                'siglas' => 'UPIITA',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA EN INGENIERÍA Y TECNOLOGÍAS AVANZADAS.',
                'clave' => '64',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '24',
                'siglas' => 'CICS Santo Tomás',
                'nombre' => 'CENTRO INTERDISCIPLINARIO DE CIENCIAS DE LA SALUD, UNIDAD SANTO TOMÁS.',
                'clave' => '65',
                'id_area' => env('AREA_CMB'),
            ],
            [
                'id' => '25',
                'siglas' => 'UPIIG',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA, CAMPUS GUANAJUATO.',
                'clave' => '66',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '26',
                'siglas' => 'UPIIZ',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA, CAMPUS ZACATECAS.',
                'clave' => '67',
                'id_area' => env('AREA_ICFM'),
            ],
            [
                'id' => '27',
                'siglas' => 'UPIIH',
                'nombre' => 'UNIDAD PROFESIONAL INTERDISCIPLINARIA DE INGENIERÍA, CAMPUS HIDALGO.',
                'clave' => '68',
                'id_area' => env('AREA_ICFM'),
            ],
        ];
        foreach($unidades_academicas as $unidad_academica)
        {
            UnidadAcademica::create($unidad_academica);
        }
    }
}
