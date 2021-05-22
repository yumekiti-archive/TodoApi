<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = ['グループ１', 'グループ２', 'グループ３'];

        foreach ($groups as $group) {
            DB::table('groups')->insert([
                'group_name' => $group,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
