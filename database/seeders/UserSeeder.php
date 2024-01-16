<?php

namespace Database\Seeders;

use App\Models\Dpl;
use App\Models\Operator;
use App\Models\Pamong;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nim' => '5324190333',
            'username' => 'alwin',
            'name' => 'Alwin Manapu',
            'email' => 'alwin@gmail.com',
            'phone' => '082393508734',
            'password' => bcrypt('123'),
            'tahun_masuk' => Carbon::createFromDate(2023, 10, 19)

        ]);

        Dpl::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'sitisuhada',
            'name' => 'Siti Sudaha S.Kom M.T',
            'email' => 'siti@gmail.com',
            'roles' => 'dpl',
            'password' => bcrypt('123')
        ]);
        
        Dpl::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'azis',
            'name' => 'azis bouty M.Kom',
            'email' => 'azis@gmail.com',
            'roles' => 'mk',
            'password' => bcrypt('123')
        ]);

        Pamong::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'guru',
            'name' => 'Amelya S.Kom',
            'email' => 'amelya89@gmail.com',
            'password' => bcrypt('123'),
            'asal_sekolah' => 'SMK 1 SUWAWA'
        ]);

        Operator::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@yahoo.com',
            'password' => bcrypt('123')
        ]);
        Operator::create([
            'uuid' => Uuid::uuid4()->toString(),
            'username' => 'kaprodi',
            'name' => 'kaprodi',
            'email' => 'kaprodi@admin',
            'password' => bcrypt('123')
        ]);
        
    }
}
