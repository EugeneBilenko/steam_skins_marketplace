<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $test_users = [
            0 => [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('test'),
                'role' => 'admin'
            ],

            1 => [
                'name' => 'support',
                'email' => 'support@test.com',
                'password' => bcrypt('test'),
                'role' => 'support'
            ],
            2 => [
                'name' => 'user',
                'email' => 'user@test.com',
                'password' => bcrypt('test'),
                'role' => 'user'
            ],
            3 => [
                'name' => 'root',
                'email' => 'root@root.com',
                'password' => bcrypt('root'),
                'role' => 'admin'
            ],

        ];

        DB::table('users')->insert($test_users);


//        factory(App\Models\User::class, 50)->create(['role' => 'user'])->each(function($u) {
//
//        });
    }
}
