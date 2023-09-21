<?php

namespace Database\Seeders;

use App\Models\Neraca;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $list;
    public function __construct()
    {
        $this->list = [
            "jenis_kegiatan" => [
                'Bulanan', 'Triwulanan', 'Bulanan', 'Bulanan', 'Triwulanan', 'Bulanan'
            ],
            "kategori_neraca_id" => [
                '1', '2', '1', '2', '1', '1'
            ],
            "kategori_id" => [
                '1', '2', '3', '4', '1', '3'
            ],
            "kegiatan" => [
                "kegiatan 1", "kegiatan 2", "kegiatan 3", "kegiatan 4", "kegiatan 5", "kegiatan 6"
            ],
            'total_sample' => [
                '10', '4', '90', '24', '11', '1'
            ],
            'target_sample' => [
                '100', '40', '90', '24', '11', '1'
            ],
            "keterangan" => [
                "keterangan 1", "keterangan 2", "keterangan 3", "keterangan 4", "keterangan 5", "keterangan 6"
            ],
            "tanggal_mulai" => [
                "2023-06-28", "2023-06-29", "2023-07-03", "2023-08-05", "2023-07-06", "2023-07-07"
            ],
            "tanggal_berakhir" => [
                "2023-07-08", "2023-07-10", "2023-12-14", "2023-09-11", "2023-08-09", "2023-08-26"
            ],
        ];
    }

    public function run(): void
    {
        $list = $this->list;
        $printData = [];
        $counter = 0;
        foreach ($list['jenis_kegiatan'] as $key => $value) {
            $counter++;
        }
        for ($i = 0; $i < $counter; $i++) {
            $printData[] = [
                "jenis_kegiatan" => $list['jenis_kegiatan'][$i],
                "kategori_neraca_id" => $list['kategori_neraca_id'][$i],
                "kategori_id" => $list['kategori_id'][$i],
                "kegiatan" => $list['kegiatan'][$i],
                "total_sample" => $list['total_sample'][$i],
                "target_sample" => $list['target_sample'][$i],
                "keterangan" => $list['keterangan'][$i],
                "tanggal_mulai" => $list['tanggal_mulai'][$i],
                "tanggal_berakhir" => $list['tanggal_berakhir'][$i],
            ];
        }
        foreach ($printData as $key => $data) {
            Neraca::create($data);
        }
    }
}
