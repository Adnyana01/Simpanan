<?php

namespace Database\Seeders;

use App\Models\KategoriKegiatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = date("Y-m-d H:i:s");
        $data = [
            ["kategori_kegiatan" => "Pelatihan Inda"],
            ["kategori_kegiatan" => "Pelatihan Petugas"],
            ["kategori_kegiatan" => "Pencacahan"],
            ["kategori_kegiatan" => "Pengolahan"]
        ];
        foreach ($data as $d) {
            KategoriKegiatan::create($d);
        }
    }
}
