<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Garantia;

class GarantiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Garantia::create([
            'usuario_id' => 1,
            'produto_id' => 1,
            'hash' => 'osidnvpaiengapisdbf',
        ]);
        Garantia::create([
            'usuario_id' => 1,
            'produto_id' => 2,
            'hash' => 'fasdfsdgadfgadfg',
        ]);
        Garantia::create([
            'usuario_id' => 1,
            'produto_id' => 3,
            'hash' => 'adhadfgasdfasdfarw',
        ]);
        Garantia::create([
            'usuario_id' => 1,
            'produto_id' => 3,
            'hash' => 'wegawreqhqdfhbaetu',
        ]);
    }
}
