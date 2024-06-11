<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(StatusTickerTableSeeder::class);
        $this->call(PaymentMethodTableSeeder::class);

        $this->call(ConfigTableSeeder::class);

        $this->call(TicketTypeTableSeeder::class);
        $this->call(RoleTableSeeder::class);

    }
}
