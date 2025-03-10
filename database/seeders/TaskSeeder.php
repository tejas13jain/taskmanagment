<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Task;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::insert([
            [
                'title' => 'Design Database Schema',
                'description' => 'Create a relational database schema for the project.',
                'priority' => 'High',
                'due_date' => now()->addDays(7),
                'status' => 'To Do',
                'user_id' => 1, // Assign random user
                'group_id' => 1, // Assign random group
                'attachment' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Develop API Endpoints',
                'description' => 'Implement CRUD operations for tasks in the API.',
                'priority' => 'Medium',
                'due_date' => now()->addDays(10),
                'status' => 'In Progress',
                'user_id' => 1,
                'group_id' => 1,
                'attachment' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
