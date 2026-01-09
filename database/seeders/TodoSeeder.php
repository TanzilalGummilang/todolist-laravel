<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $todo = new Todo();
        $todo->todo = "Learning Laravel";
        $todo->save();

        $todo = new Todo();
        $todo->todo = "Learning Vue";
        $todo->save();
    }
}
