<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "Hehe Tester";
        $user->email = "test@localhost";
        $user->password = bcrypt("test");
        $user->save();

        $user = new User();
        $user->name = "Second Tester";
        $user->email = "second@localhost";
        $user->password = bcrypt("test");
        $user->save();
    }
}
