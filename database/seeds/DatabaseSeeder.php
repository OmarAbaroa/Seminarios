<?php

use Illuminate\Database\Seeder;
    

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
        $this->call(SexoSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(ProgramaAcademicoSeeder::class);
        $this->call(UnidadAcademicaSeeder::class);
        $this->call(UnidadAcademicaProgramaAcademicoSeeder::class);
        $this->call(EscolaridadSeeder::class);
        $this->call(FuncionariosSeeder::class);
        $this->call(DirectorSeeder::class);
        $this->call(TipoSeminarioSeeder::class);
    }
}
