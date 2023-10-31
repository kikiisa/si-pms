<?php

namespace Database\Seeders;

use App\Models\Pamong;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class PamongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pamong::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'fatmasuhada',
            'name' => 'Fatma Suhada',
            'email' => 'fatma@gmail',
            'password' => bcrypt('123'),
            'asal_sekolah' => 'SMK 2 PAGUYAMAN',
          
        ]);
    }
}
