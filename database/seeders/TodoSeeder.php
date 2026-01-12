<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datasets = [
            'test@localhost' => ['Learning Laravel', 'Learning Eloquent', 'Learning Seeder'],
            'second@localhost' => ['Playing Game', 'Watching Movie', 'Aerobics'],
        ];

        foreach ($datasets as $email => $todos) {
            $user = User::where('email', $email)->first();

            if ($user) {
                $data = [];
                foreach ($todos as $todoText) {
                    $data[] = [
                        'user_id' => $user->id,
                        'todo' => $todoText,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                Todo::insert($data);
            }
        }
    }
}
