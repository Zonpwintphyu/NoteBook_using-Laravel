<?php

namespace Database\Seeders;

use Database\Seeders\PostSeeder;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    
    public function run()
    {
        $this->call([ PostSeeder::class]);
    }
}
