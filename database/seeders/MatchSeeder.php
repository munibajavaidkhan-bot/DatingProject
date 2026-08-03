<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MatchSeeder extends Seeder
{
    public function run(): void
    {
        Artisan::call('love:match', ['--limit' => 50]);
        $this->command->info(trim(Artisan::output()));
    }
}
