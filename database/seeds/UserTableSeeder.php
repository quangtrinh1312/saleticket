<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserTableSeeder extends Seeder
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
                'name' => 'Bảo tàng mỹ thuật',
                'username' => 'baotangmythuat',
                'password' => Hash::make('123456'),
                'link' => 'https://ttquanlykhaithacnhaadmindemo.vnpt-invoice.com.vn/',
                'account' => 'ttquanlykhaithacnhaadmin',
                'acpass' => 'Einv@oi@vn#pt20',
                'username_api' => 'ttqlktnhaservice',
                'password_api' => '123456aA@', 
                'pattern' => '01BLP0-001', 
                'serial' => 'KT-23E', 
                'cus_name' => 'Khách lẻ',
                'prod_name' => 'Phí thăm quan',
                'address' => 'Thành Phố Đà Nẵng',
                'mst' => '0400603108',
                'address_user' => '01 Trưng Nữ Vương, Quận Hải Châu, Thành phố Đà Nẵng, Việt Nam',
                'number_max' => 999999,
                'api' => 'VNPT',
            ],

            // [
            //     'name' => 'NV2',
            //     'username' => 'nv2',
            //     'password' => Hash::make('123456'),
            //     'link' => 'https://demows.vin-bienlai.com/',
            //     'account' => 'admin_bizdi',
            //     'acpass' => '12345678',
            //     'username_api' => '',
            //     'password_api' => '', 
            //     'pattern' => '01BLP0-001', 
            //     'serial' => 'BI-23T', 
            //     'cus_name' => 'Khách lẻ',
            //     'prod_name' => 'Phí thăm quan',
            //     'address' => 'Thành Phố Đà Nẵng',
            //     'mst' => '0401486901-999',
            //     'address_user' => 'Bảo Tàng Mỹ Thuật',
            //     'number_max' => 999999,
            //     'api' => 'VIN-CA',
            //     'role_id' => '1'
            // ]

        ];

        User::truncate();
        User::insert($data);
    }

}
