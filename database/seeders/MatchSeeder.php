<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class MatchSeeder extends Seeder
{
    public function run(): void
    {
        try {
            Artisan::call('love:match', ['--limit' => 50]);
            $this->command->info(trim(Artisan::output()));
        } catch (\Exception $e) {
            $this->command->warn('MatchSeeder skipped: ' . $e->getMessage());
        }
    }
}
