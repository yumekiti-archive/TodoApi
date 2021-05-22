<?php

use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $titles = ['テスト１', 'テスト２', 'テスト３'];

        foreach ($titles as $title) {
            DB::table('todos')->insert([
                'title' => $title,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }

    }
}
