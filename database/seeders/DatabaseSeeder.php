<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsuarioSeeder::class);
        $this->call(produtoSeeder::class);
        $this->call(UsuarioProdutosSeeder::class);
        $this->call(GarantiaSeeder::class);
        $this->call(ForumSeeder::class);
        $this->call(ComentarioSeeder::class);
        $this->call(LikeComentarioSeeder::class);
        // \App\Models\Usuario::factory(10)->create();

        // \App\Models\Usuario::factory()->create([
        //     'name' => 'Test Usuario',
        //     'email' => 'test@example.com',
        // ]);
    }
}
