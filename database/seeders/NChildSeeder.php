<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NeracaChild;

class NChildSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $list;
    public function __construct()
    {
        $this->list = [
            "parent_id" => [
                '1', '2', '3', '4', '1', '3'
            ],
            "kategori_id" => [
                '1', '2', '3', '1', '1', '3'
            ],
            "start" => [
                "2023-06-28", "2023-07-29", "2023-08-03", "2023-02-05", "2023-04-06", "2023-01-07"
            ],
            "end" => [
                "2023-07-08", "2023-08-10", "2023-12-14", "2023-07-11", "2023-07-09", "2023-02-07"
            ],
        ];
    }
    public function run(): void
    {
        $list = $this->list;
        $printData = [];
        $counter = 0;
        foreach ($list['parent_id'] as $key => $value) {
            $counter++;
        }
        for ($i = 0; $i < $counter; $i++) {
            $printData[] = [
                "parent_id" => $list['parent_id'][$i],
                "kategori_id" => $list['kategori_id'][$i],
                "start" => $list['start'][$i],
                "end" => $list['end'][$i],
            ];
        }
        foreach ($printData as $key => $data) {
            NeracaChild::create($data);
        }
    }
}
