<?php

use Illuminate\Database\Seeder;
use App\Models\StatusTicker;

class StatusTickerTableSeeder extends Seeder
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
                'title' => 'Xuất vé thành công',
            ],

            [
                'title' => 'Xuất vé đã hủy',
            ]

        ];

        StatusTicker::truncate();
        StatusTicker::insert($data);
    }
}
