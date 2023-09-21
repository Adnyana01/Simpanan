<?php

namespace App\Helpers;

use App\Models\KategoriKegiatan;
use App\Models\Neraca;
use App\Models\NeracaChild;
use App\Models\KategoriNeraca;

class Helper
{
    protected $neraca;
    protected $nPrC;
    protected $nL;
    protected $nK;
    public function __construct()
    {
        $this->neraca = new Neraca();
        $this->nPrC = new NeracaChild();
        $this->nL = new KategoriNeraca();
        $this->nK = new KategoriKegiatan();
    }
    public function neracaJSON()
    {
        // ============================Task Color fill function
        function taskColorFill($kategori)
        {
            switch ($kategori) {
                case 'Pelatihan Inda':
                    return "#ea9999";
                    break;
                case 'Pelatihan Petugas':
                    return "#ffe599";
                    break;
                case 'Pencacahan':
                    return "#b6d7a8";
                    break;
                case 'Pengolahan':
                    return "#9fc5e8";
                    break;

                default:
                    dd("Kategori tidak ada");
                    break;
            }
        }
        // ============================Create Neraca Produksi Child Data
        function nPrChild($value)
        {
            $data = [
                0 => [
                    "id" => $value->id . "_1",
                    "start" =>  $value->tanggal_mulai,
                    "end" =>  $value->tanggal_berakhir,
                    "kategori" => $value->kategori->kategori_kegiatan,
                    "fill" => taskColorFill($value->kategori->kategori_kegiatan)
                ]
            ];
            $counter = 1;
            // create nPrC children data
            foreach ($value->child as $k => $v) {
                $data[$counter] = [
                    "id" => $v->parent->id . "_" . $counter + 1,
                    "start" =>  $v->start,
                    "end" =>  $v->end,
                    "kategori" => $v->kategori->kategori_kegiatan,
                    "fill" => taskColorFill($v->kategori->kategori_kegiatan)
                ];
                $counter++;
            }
            return $data;
        }
        // ============================Create and Return data
        $data = [];
        $counter = 0;
        foreach ($this->neraca->all() as $key => $value) {
            // dd($value->nList);
            if (sizeof($value->child) != 0) {
                $data[$counter] = [
                    "id" => $value->id,
                    "J_K" => $value->jenis_kegiatan,
                    "neraca" => $value->nList->kategori_neraca,
                    "kegiatan" => $value->kegiatan,
                    "T_S" => $value->total_sample,
                    "keterangan" => $value->keterangan,
                    "periods" => nPrChild($value)
                ];
            } else {
                $data[$counter] = [
                    "id" => $value->id,
                    "J_K" => $value->jenis_kegiatan,
                    "neraca" => $value->nList->kategori_neraca,
                    "kegiatan" => $value->kegiatan,
                    "T_S" => $value->total_sample,
                    "keterangan" => $value->keterangan,
                    "periods" => [
                        0 => [
                            "id" => $value->id . "_1",
                            "start" =>  $value->tanggal_mulai,
                            "end" =>  $value->tanggal_berakhir,
                            "kategori" => $value->kategori->kategori_kegiatan,
                            "fill" => taskColorFill($value->kategori->kategori_kegiatan)
                        ]

                    ]
                ];
            }
            $counter++;
        }
        return $data;
    }
    public function neracalist($data)
    {
        $test = [];
        foreach ($this->nL->all() as $value) {
            if ($data == $value->kategori_neraca) {
                return $value->id;
            }
        }
    }
}
