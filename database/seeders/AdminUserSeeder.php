<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@loveproject.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('12345678'),
                'role'     => 'admin',
                'status'   => 'active',
                'email_verified_at' => now(),
            ]
        );

        Profile::updateOrCreate(
            ['user_id' => $admin->id],
            [
                'first_name'  => 'Admin',
                'last_name'   => 'User',
                'gender'      => 'male',
                'city'        => 'New York',
                'country'     => 'USA',
                'is_complete' => true,
                'is_verified' => true,
            ]
        );

        $this->command->info('✅ Admin created: admin@loveproject.com / 12345678');
    }
}