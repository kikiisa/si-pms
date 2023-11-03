<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pengaturan::create([
            'title' => 'Sistem Informasi PMS - UNIVERSITAS NEGERI GORONTALO',
            'judul' => 'Sistem Informasi PMS',
            'sub_judul' => 'Universitas Negeri Gorontalo',
            'deskripsi_full' => 'Sistem Informasi PMS - UNIVERSITAS NEGERI GORONTALO',
            'sk_rektor' => 'Sertifikat Rektor',
            'surat_pernyataan' => 'Surat Pernyataan',
        ]);
    }
}
