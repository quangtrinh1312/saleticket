<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Quản lí'
            ],

            [
                'name' => 'Nhân viên'
            ]

        ];

        Role::truncate();
        Role::insert($data);
    }
}
