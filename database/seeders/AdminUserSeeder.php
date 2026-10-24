<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => env('ADMIN_USERNAME', 'Tinhkendy')],
            [
                'name' => 'Tinh Kendy',
                'email' => env('ADMIN_EMAIL', 'admin@example.com'),
                'password' => Hash::make(
                    env('ADMIN_PASSWORD', 'ChangeThisPassword123!')
                ),
                'is_admin' => true,
            ]
        );
    }
}