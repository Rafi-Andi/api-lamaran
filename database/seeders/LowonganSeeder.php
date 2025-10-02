<?php

namespace Database\Seeders;

use App\Models\LowonganKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $data = [
            [
                "judul" => "Laravel Developer",
                "deskripsi" => "di cari developer laravel yang jago"
            ],
            [
                "judul" => "SmartContract Developer",
                "deskripsi" => "di cari developer solidity untuk smart contract"
            ],
            [
                "judul" => "AI Developer",
                "deskripsi" => "di cari AI developer yang jago"
            ],
            [
                "judul" => "Backend Developer",
                "deskripsi" => "di cari Backend developer yang jago",
                "sedang_terbuka" => 0
            ],
            [
                "judul" => "Frontend Developer",
                "deskripsi" => "di cari frontend developer yang jago",
                "sedang_terbuka" => 0
            ],
        ];

        foreach ($data as $item) {
            LowonganKerja::create($item);
        }
    }
}
