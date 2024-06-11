<?php

use Illuminate\Database\Seeder;
use App\Models\Config;


class ConfigTableSeeder extends Seeder
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
                'name' => 'BẢO TÀNG MỸ THUẬT ĐÀ NẴNG',
                'link' => 'https://vin-bienlai.vn/',
                'account' => 'KTT',
                'acpass' => '12345678',
                'username_api' => '',
                'password_api' => '', 
                'pattern' => '01BLP0-001', 
                'serial' => 'BT-23E', 
                'cus_name' => 'Khách lẻ',
                'prod_name' => 'Phí thăm quan',
                'address' => 'Thành Phố Đà Nẵng',
                'mst' => '0401822430',
                'address_user' => '78 Lê Duẩn, Thạch Thang, Hải Châu, Đà Nẵng',
                'number_max' => 999999,
                'api' => 'VIN-CA',
            ]

        ];

        Config::truncate();
        Config::insert($data);
    }
}
