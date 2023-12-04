<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUserExists = User::where('email', env('ADMIN_EMAIL'))->exists();
        if ($adminUserExists) {
            return;
        }
        $user = new User();
        $user->email = env('ADMIN_EMAIL');
        $user->name = env('ADMIN_NAME');
        $user->password = bcrypt(env('ADMIN_PASSWORD'));
        $user->username = strtolower(str_replace(' ', '-', env('ADMIN_NAME')));
        $user->save();
    }
}
