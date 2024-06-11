<?php

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [
                'title' => 'Vé vào cổng',
                'name' => 'Vé vào cổng',
                'post_vat_price' => 1000,
                'pre_vat_price' => 1000,
                'vat' => 0,
                'note' => '',
                'pattern' => '01BLP0-001',
                'serial' => 'BI-23T',
                'is_actived' => true,
                'duration' => '',
                'expired' => '',
            ],
        ];

        TicketType::truncate();
        TicketType::insert($data);
    }
}
