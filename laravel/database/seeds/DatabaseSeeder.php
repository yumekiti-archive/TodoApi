<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Group;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(TodoTableSeeder::class);

        $users = factory(User::class, 5)->create([
            'group_id' => 1
        ]);
        $group = Group::firstOrFail();
        $users->each(function($user) use($group){
            $user->group()->associate($group);
        });
        $users->each(function(User $user) { 
            $user->tokens()->create([
                'name' => 'dev',
                'token' => hash('sha256', 'test-' . $user->id),
                'abilities' => ['*']
            ]);
        });

        

    }
}
