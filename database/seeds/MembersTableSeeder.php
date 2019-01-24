<?php

use Illuminate\Database\Seeder;
use App\Domain\Entities\Member;
use Carbon\Carbon;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::insert([
            [
                'id'           => 1,
                'user_id'      => 1,
                'npm'          => 1604030100037,
                'nama'         => 'Admin Ferdy',
                'tempat_lahir' => 'Malang',
                'tgl_lahir'    => '1997-12-04',
                'jk'           => 'L',
                'prodi'        => 'TI',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ],
            [
                'id'           => 2,
                'user_id'      => 2,
                'npm'          => 1604030100001,
                'nama'         => 'User Indah',
                'tempat_lahir' => 'Banjarmasin',
                'tgl_lahir'    => '2019-01-01',
                'jk'           => 'P',
                'prodi'        => 'TI',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now()
            ],
        ]);
    }
}
