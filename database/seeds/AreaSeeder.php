<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $areas = [
            [
                'id' => env('AREA_CMB'),
                'nombre' => 'Ciencias Médico Biológicas',
            ],
            [
                'id' => env('AREA_CSA'),
                'nombre' => 'Ciencias Sociales y Administrativas',
            ],
            [
                'id' => env('AREA_ICFM'),
                'nombre' => 'Ingeniería y Ciencias Físico Matemáticas',
            ],
        ];
        foreach($areas as $area)
        {
            Area::create($area);
        }
    }
}
