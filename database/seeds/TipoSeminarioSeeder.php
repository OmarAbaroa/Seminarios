<?php

use Illuminate\Database\Seeder;
use App\TipoSeminario;

class TipoSeminarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposSeminarios = [
            [
                'id' => env('SEMINARIO_TIPO_PRESENCIAL'),
                'nombre' => 'PRESENCIAL',
            ],
            [
                'id' => env('SEMINARIO_TIPO_VIRTUAL'),
                'nombre' => 'VIRTUAL',
            ],
        ];
        foreach($tiposSeminarios as $tipoSeminario)
        {
            TipoSeminario::create($tipoSeminario);
        }
    }
}

