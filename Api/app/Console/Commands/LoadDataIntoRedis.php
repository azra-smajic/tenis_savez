<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class LoadDataIntoRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data-into-redis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load data from database into Redis';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Example query to get data from the database
        $data = DB::table('roles')->get();

        $key = 'roles';
        Redis::set($key, json_encode($data));

        $this->info('Data has been loaded into Redis.');
    }
}