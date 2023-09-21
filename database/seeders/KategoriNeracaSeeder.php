<?php

namespace Database\Seeders;

use App\Models\KategoriNeraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KategoriNeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = date("Y-m-d", time());
        $data = [
            ['kategori_neraca' => 'Produksi'],
            ['kategori_neraca' => 'Pengeluaran'],
        ];
        foreach ($data as $d) {
            KategoriNeraca::create($d);
        }
    }
}
