<?php

namespace Database\Seeders;

use App\Models\UserAccount;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('DEFAULT_ADMIN_EMAIL', 'admin@rm.com');
        $username = env('DEFAULT_ADMIN_USERNAME', 'admin');

        $admin = UserAccount::where('email', $email)
            ->orWhere('username', $username)
            ->first() ?? new UserAccount();

        $admin->fill([
            'username' => $username,
            'email' => $email,
            'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'admin123')),
            'role' => 'admin',
            'is_active' => 1,
        ]);

        $admin->save();
    }
}
