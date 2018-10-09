<?php

use Illuminate\Database\Seeder;
use App\Escolaridad;

class EscolaridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $escolaridades = [
            [
                'nombre' => 'Dr.',
            ],
            [
                'nombre' => 'M. en C.',
            ],
            [
                'nombre' => 'Ing.',
            ],
            [
                'nombre' => 'Lic.',
            ],
            [
                'nombre' => 'C.',
            ],
            

        ];
        foreach($escolaridades as $escolaridad)
        {
            Escolaridad::create($escolaridad);
        }
    }
}
