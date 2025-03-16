<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $username = 'jason';
        $password = '123456';
        User::query()->updateOrCreate([
            'username' => $username,
        ], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $this->command->info("用户名: {$username}");
        $this->command->info("密码: {$password}");
    }
}
