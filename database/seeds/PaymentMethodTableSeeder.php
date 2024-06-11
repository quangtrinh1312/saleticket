<?php

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodTableSeeder extends Seeder
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
                'title' => 'Tiền mặt',
            ],
            
            [
                'title' => 'Chuyển khoản',
            ],

            [
                'title' => 'Tiền mặt/chuyển khoản',
            ],
        ];


        PaymentMethod::truncate();
        PaymentMethod::insert($data);

    }
}
