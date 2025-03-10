<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\GroupUser;
class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'Developers Team',
            'project_id' => 1,
        ]);

        GroupUser::create([
            'group_id' => 1,
            'user_id' => 3,
        ]);

        Group::create([
            'name' => 'Design Team',
            'project_id' => 2,
        ]);
    }
}
