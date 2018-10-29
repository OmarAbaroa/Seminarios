<?php

use Illuminate\Database\Seeder;
use App\Funcionario;

class FuncionariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $funcionarios = [
            [
                'id_escolaridad' => 2,
                'nombre' => 'EDGAR GREGORIO',
                'apellidos' => 'CARCAMO VILLALOBOS',
                'nombre_completo' => 'CARCAMO VILLALOBOS EDGAR GREGORIO',
                'cargo' => 'JEFE DEL DEPARTAMENTO DE TRAYECTORIAS ESTUDIANTILES',
                'id_sexo' => env('SEXO_H'),
            ],
            [
                'id_escolaridad' => 4,
                'nombre' => 'CECILIO SHAMAR',
                'apellidos' => 'SÁNCHEZ NAVA',
                'nombre_completo' => 'SÁNCHEZ NAVA CECILIO SHAMAR',
                'cargo' => 'JEFE DE LA DIVISIÓN DE OPERACIÓN DE UNIDADES ACADÉMICAS',
                'id_sexo' => env('SEXO_H'),
            ],
            [
                'id_escolaridad' => 1,
                'nombre' => 'EMMANUEL ALEJANDRO',
                'apellidos' => 'MERCHÁN CRUZ',
                'nombre_completo' => 'MERCHÁN CRUZ EMMANUEL ALEJANDRO',
                'cargo' => 'SECRETARIO ACADÉMICO DEL IPN',
                'id_sexo' => env('SEXO_H'),
            ],
            [
                'id_escolaridad' => 4,
                'nombre' => 'MARISELA',
                'apellidos' => 'CABRERA ROJAS',
                'nombre_completo' => 'CABRERA ROJAS MARISELA',
                'cargo' => 'DIRECTOR DE ADMINISTRACIÓN ESCOLAR',
                'id_sexo' => env('SEXO_M'),
            ],
            [
                'id_escolaridad' => 5,
                'nombre' => 'EFREN',
                'apellidos' => 'DORADO MORALES',
                'nombre_completo' => 'EFREN DORADO MORALES',
                'cargo' => 'JEFE DE COMPETENCIAS DOCENTES',
                'id_sexo' => env('SEXO_M'),
            ],
        ];
        foreach($funcionarios as $funcionario)
        {
            Funcionario::create($funcionario);
        }
    }
}
