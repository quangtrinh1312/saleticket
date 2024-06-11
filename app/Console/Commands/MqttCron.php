<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MqttCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'mqtt:cron'; //banve
    protected $signature = 'eticket.bizdi.net.mqtt:cron'; //https://eticket.bizdi.net/

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kết nối mqtt tự động';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        mqtt();
    }
}
