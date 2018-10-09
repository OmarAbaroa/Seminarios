<?php

use Illuminate\Database\Seeder;
use App\TipoUsuario;
use App\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'id' => env('USUARIO_ADMIN'),
                'nombre' => 'Administrador',
            ],
            [
                'id' => env('USUARIO_ANALISTA'),
                'nombre' => 'Analista',
            ],
            
        ];
        foreach($tipos as $tipo)
        {
            TipoUsuario::create($tipo);
        }

        $usuarios = [
            [
                'nombre' => 'admin',
                'email' => 'correo@mail.com',
                'password' => \Hash::make('admin'),
                'id_tipo_usuario' => env('USUARIO_ADMIN'),
            ],
            [
                'nombre' => 'edgar',
                'email' => 'edgar@mail.com',
                'password' => \Hash::make('12345678'),
                'id_tipo_usuario' => env('USUARIO_ADMIN'),
            ],
            [
                'nombre' => 'Magaly',
                'email' => 'magaly@mail.com',
                'password' => \Hash::make('12345678'),
                'id_tipo_usuario' => env('USUARIO_ANALISTA'),
            ],
            [
                'nombre' => 'Antonio',
                'email' => 'antonio@mail.com',
                'password' => \Hash::make('12345678'),
                'id_tipo_usuario' => env('USUARIO_ANALISTA'),
            ],
            [
                'nombre' => 'Barbara',
                'email' => 'barbara@mail.com',
                'password' => \Hash::make('12345678'),
                'id_tipo_usuario' => env('USUARIO_ANALISTA'),
            ],
        ];
        foreach($usuarios as $usuario)
        {
            Usuario::create($usuario);
        }
    }
}
