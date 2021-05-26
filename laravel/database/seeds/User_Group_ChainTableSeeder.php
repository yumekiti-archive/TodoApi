<?php

use Illuminate\Database\Seeder;

class User_Group_ChainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('user_group_chains')->insert([
            'user_id' => 1,
            'group_id' => 1
        ]);

    }
}
