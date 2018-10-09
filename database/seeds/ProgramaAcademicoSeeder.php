<?php

use Illuminate\Database\Seeder;
use App\ProgramaAcademico;
class ProgramaAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $programas_academicos = [
            ['nombre' => 'INGENIERÍA EN COMUNICACIONES Y ELECTRÓNICA'], //1
            ['nombre' => 'INGENIERÍA EN CONTROL Y AUTOMATIZACIÓN'], //2
            ['nombre' => 'INGENIERÍA ELÉCTRICA'], //3
            ['nombre' => 'INGENIERÍA EN SISTEMAS AUTOMOTRICES'], //4
            ['nombre' => 'INGENIERÍA CIVIL'], //5
            ['nombre' => 'INGENIERÍA QUÍMICA INDUSTRIAL'], //6
            ['nombre' => 'INGENIERÍA QUÍMICA PETROLERA'], //7
            ['nombre' => 'INGENIERÍA EN METALURGIA Y MATERIALES'], //8
            ['nombre' => 'LICENCIATURA EN FÍSICA Y MATEMÁTICAS'], //9
            ['nombre' => 'INGENIERÍA MATEMÁTICA'], //10
            ['nombre' => 'INGENIERÍA TEXTIL'], //11
            ['nombre' => 'INGENIERÍA MECÁNICA'], //12
            ['nombre' => 'INGENIERÍA EN COMPUTACIÓN'], //13
            ['nombre' => 'INGENIERÍA EN ROBÓTICA INDUSTRIAL'], //14
            ['nombre' => 'INGENIERÍA EN AERONÁUTICA'], //15
            ['nombre' => 'INGENIERO ARQUITECTO'], //16
            ['nombre' => 'INGENIERÍA PETROLERA'], //17
            ['nombre' => 'INGENIERÍA TOPOGRÁFICA Y FOTOGRAMETRÍA'], //18
            ['nombre' => 'INGENIERÍA GEOLÓGICA'], //19
            ['nombre' => 'INGENIERÍA GEOFÍSICA'], //20
            ['nombre' => 'CONTADOR PÚBLICO'], //21
            ['nombre' => 'LICENCIATURA EN RELACIONES COMERCIALES'], //22
            ['nombre' => 'LICENCIATURA EN NEGOCIOS INTERNACIONALES'], //23
            ['nombre' => 'LICENCIATURA EN ADMINISTRACIÓN Y DESARROLLO EMPRESARIAL'], //24
            ['nombre' => 'LICENCIATURA EN ECONOMÍA'], //25
            ['nombre' => 'LICENCIATURA EN TURISMO'], //26
            ['nombre' => 'QUÍMICO BACTERIÓLOGO PARASITÓLOGO'], //27
            ['nombre' => 'BIÓLOGO'], //28
            ['nombre' => 'INGENIERO BIOQUÍMICO'], //29
            ['nombre' => 'QUÍMICO FARMACÉUTICO INDUSTRIAL'], //30
            ['nombre' => 'INGENIERÍA EN SISTEMAS AMBIENTALES'], //31
            ['nombre' => 'LICENCIATURA EN BIOLOGÍA'], //32
            ['nombre' => 'MÉDICO CIRUJANO Y PARTERO'], //33
            ['nombre' => 'MÉDICO CIRUJANO Y HOMEÓPATA'], //34
            ['nombre' => 'LICENCIATURA EN ENFERMERÍA'], //35
            ['nombre' => 'LICENCIATURA EN ENFERMERÍA Y OBSTETRICIA'], //36
            ['nombre' => 'INGENIERÍA INDUSTRIAL'], //37
            ['nombre' => 'LICENCIATURA EN CIENCIAS DE LA INFORMÁTICA'], //38
            ['nombre' => 'INGENIERÍA EN TRANSPORTE'], //39
            ['nombre' => 'LICENCIATURA EN ADMINISTRACIÓN INDUSTRIAL'], //40
            ['nombre' => 'INGENIERÍA EN INFORMÁTICA'], //41
            ['nombre' => 'LICENCIATURA EN ODONTOLOGÍA'], //42
            ['nombre' => 'LICENCIATURA EN NUTRICIÓN'], //43
            ['nombre' => 'LICENCIATURA EN OPTOMETRÍA'], //44
            ['nombre' => 'LICENCIATURA EN TRABAJO SOCIAL'], //45
            ['nombre' => 'INGENIERÍA BIOTECNOLÓGICA'], //46
            ['nombre' => 'INGENIERÍA EN ALIMENTOS'], //47
            ['nombre' => 'INGENIERÍA BIOMÉDICA'], //48
            ['nombre' => 'INGENIERÍA AMBIENTAL'], //49
            ['nombre' => 'INGENIERÍA FARMACÉUTICA'], //50
            ['nombre' => 'INGENIERÍA EN SISTEMAS COMPUTACIONALES'], //51
            ['nombre' => 'INGENIERÍA MECATRÓNICA'], //52
            ['nombre' => 'INGENIERÍA TELEMÁTICA'], //53
            ['nombre' => 'INGENIERÍA BIÓNICA'], //54
            ['nombre' => 'LICENCIATURA EN PSICOLOGÍA'], //55
            ['nombre' => 'LICENCIATURA EN COMERCIO INTERNACIONAL'], //56
            ['nombre' => 'INGENIERÍA METALÚRGICA'], //57
        ];
        foreach($programas_academicos as $programa_academico)
        {
            ProgramaAcademico::create($programa_academico);
        }
    }
}
