<?php 

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        Project::create([
            'name' => 'Website Development',
            'description' => 'Developing a company website',
            'status' => 'In Progress',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'user_id' => 1, // Change based on your user ID
        ]);
    }
}
