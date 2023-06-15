<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'nome' => "conta de teste",
            'email' => "teste@teste.com.br",
            'cpfcnpj' => '123.456.789-10',
            'telefone' => '55 27 98888-7777',
            'password' => Hash::make("1234567890"),
        ]);
        Usuario::create([
            'nome' => "conta de teste 2",
            'email' => "teste2@teste.com.br",
            'cpfcnpj' => '123.456.789-10',
            'telefone' => '55 27 98888-7777',
            'password' => Hash::make("1234567890"),
        ]);
    }
}
