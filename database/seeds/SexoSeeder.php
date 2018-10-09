<?php

use Illuminate\Database\Seeder;
use App\Sexo;

class SexoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sexos = [
            [
                'id' => env('SEXO_H'),
                'nombre' => 'H',
            ],
            [
                'id' => env('SEXO_M'),
                'nombre' => 'M',
            ],
        ];
        foreach($sexos as $sexo)
        {
            Sexo::create($sexo);
        }
    }
}
