<?php

use Illuminate\Database\Seeder;
use App\Director;

class DirectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directores = [
            [
                'id' => '1',
                'nombre_cargo' => 'DR. RICARDO OCTAVIO A. MOTA PALOMINO',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '1',
            ],
            [
                'id' => '2',
                'nombre_cargo' => 'ING. LUIS IGNACIO ESPINO MÁRQUEZ',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '2',
            ],
            [
                'id' => '3',
                'nombre_cargo' => 'M. EN C. DANTE REAL MIRANDA',
                'cargo' => 'DIRECTOR DE LA',                
                'id_unidad_academica' => '3',
            ],
            [
                'id' => '4',
                'nombre_cargo' => 'DR. MIGUEL TUFIÑO VELÁZQUEZ',
                'cargo' => 'DIRECTOR DE LA',                
                'id_unidad_academica' => '4',
            ],
            [
                'id' => '5',
                'nombre_cargo' => 'ING. ARTURO DIANICIO ARAUZO',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '5',
            ],
            [
                'id' => '6',
                'nombre_cargo' => 'ING. JUAN MANUEL VELÁZQUEZ PETO',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '6',
            ],
            [
                'id' => '7',
                'nombre_cargo' => 'M. EN C. RICARDO CORTÉZ OLIVERA',
                'cargo' => 'DIRECTOR INTERINO DE LA',
                'id_unidad_academica' => '7',
            ],
            [
                'id' => '8',
                'nombre_cargo' => 'ING. ADELAIDO ILDELFONSO MATIAS DOMINGEZ',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '8',
            ],
            [
                'id' => '9',
                'nombre_cargo' => 'M. EN E. RICARDO RIVERA RODRÍGUEZ',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '9',
            ],
            [
                'id' => '10',
                'nombre_cargo' => 'ING. FRANCISCO JAVIER ESCAMILLA LÓPEZ',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '10',
            ],
            [
                'id' => '11',
                'nombre_cargo' => 'C.P. MANELIC MAGANDA DE LOS SANTOS',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '11',
            ],
            [
                'id' => '12',
                'nombre_cargo' => 'M. EN C. FILIBERTO CIPRIANO MARÍN',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '12',
            ],
            [
                'id' => '13',
                'nombre_cargo' => 'LIC. MARÍA GUADALUPE VARGAS JACOBO',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '13',
            ],
            [
                'id' => '14',
                'nombre_cargo' => 'DRA. SILVIA GALICIA VILLANUEVA',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '14',
            ],
            [
                'id' => '15',
                'nombre_cargo' => 'DR. MARIO ALBERTO RODRÍGUEZ CASAS',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '15',
            ],
            [
                'id' => '16',
                'nombre_cargo' => 'DR. ELEAZAR LARA PADILLA',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '16',
            ],
            [
                'id' => '17',
                'nombre_cargo' => 'M. EN C. LORENA GARCÍA MORALES',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '17',
            ],
            [
                'id' => '18',
                'nombre_cargo' => 'M. EN C. GUADALUPE GONZÁLEZ DÍAZ',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '18',
            ],
            [
                'id' => '19',
                'nombre_cargo' => 'LIC. JAIME ARTURO MENESES GALVÁN',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '19',
            ],
            [
                'id' => '20',
                'nombre_cargo' => 'M. EN C. CARLOS QUIROZ TÉLLEZ',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '20',
            ],
            [
                'id' => '21',
                'nombre_cargo' => 'DRA. MARÍA GUADALUPE RAMÍREZ SOTELO',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '21',
            ],
            [
                'id' => '22',
                'nombre_cargo' => 'LIC. ANDRÉS ORTIGOZA CAMPOS',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '22',
            ],
            [
                'id' => '23',
                'nombre_cargo' => 'M. EN C. RAMÓN HERRERA ÁVILA',
                'cargo' => 'DIRECTOR INTERINO DE LA',
                'id_unidad_academica' => '23',
            ],
            [
                'id' => '24',
                'nombre_cargo' => 'D. EN C. ÁNGEL MILIAR GARCÍA',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '24',
            ],
            [
                'id' => '25',
                'nombre_cargo' => 'DRA. ANGÉLICA BEATRIZ RAYA RANGEL',
                'cargo' => 'DIRECTORA DE LA',
                'id_unidad_academica' => '25',
            ],
            [
                'id' => '26',
                'nombre_cargo' => 'M. EN C. JUAN ALBERTO ALVARADO OLIVARES',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '26',
            ],
            [
                'id' => '27',
                'nombre_cargo' => 'DR. ADOLFO ESCAMILLA ESQUIVEL',
                'cargo' => 'DIRECTOR DE LA',
                'id_unidad_academica' => '27',
            ],
            [
                'id' => '28',
                'nombre_cargo' => 'C. P. HUGO FRANCISCO BRAVO MALPICO',
                'cargo' => 'DIRECTOR GENERAL DEL ',
                'id_unidad_academica' => '28',
            ],
            [
                'id' => '29',
                'nombre_cargo' => 'Ing. TONATIUH AGUILETA MONDRAGÓN',
                'cargo' => 'COORDINADOR DEL',
                'id_unidad_academica' => '29',
            ],
            [
                'id' => '30',
                'nombre_cargo' => 'Lic. JOSÉ LUIS GALINDO ALMARAZ',
                'cargo' => 'DIRECTOR TÉCNICO DEL',
                'id_unidad_academica' => '31',
            ],
            [
                'id' => '31',
                'nombre_cargo' => 'Ing. ANA HERNÁNDEZ MAYÉN',
                'cargo' => 'DIRECTORA DEL',
                'id_unidad_academica' => '32',
            ],
            [
                'id' => '32',
                'nombre_cargo' => 'M. en C. MIGUEL ÁNGEL BAÑUELOS DOSAMANTE',
                'cargo' => 'RECTOR DEL',
                'id_unidad_academica' => '33',
            ],
            [
                'id' => '33',
                'nombre_cargo' => 'C. P. ARTURO SOLIS TORRES',
                'cargo' => 'RECTOR DE LA',
                'id_unidad_academica' => '34',
            ],
        ];

        foreach($directores as $director)
        {
            Director::create($director);
        }
    }
}