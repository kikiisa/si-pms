<?php

namespace Database\Seeders;

use App\Models\LogHarian;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class LogBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::create(2024,1, 1);
        $endDate = Carbon::now();

        $user_id = 1;
        $weekNumber = 1;

        while ($startDate->lessThanOrEqualTo($endDate)) {
            LogHarian::create([
                'uuid' => Str::uuid(),
                'user_id' => $user_id,
                'deskripsi' => 'Deskripsi kegiatan',
                'rencana_kegiatan' => 'Rencana kegiatan',
                'mulai' => '08:00:00', // Ganti sesuai kebutuhan
                'berakhir' => '10:00:00', // Ganti sesuai kebutuhan
                'category' => 'mingguan', // Ganti sesuai kebutuhan
               
                'created_at' => $startDate,
            ]);
            $startDate->addDay(); // Tambah 1 hari
            // Jika sudah akhir minggu, reset dan lanjutkan ke minggu berikutnya
            if ($startDate->dayOfWeek == 0) {
                $weekNumber++;
            }
        }
    }
}
