<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Diego',
            'email' => 'diego@f.uy',
            'password' => '$2y$10$2zWWsrgshwyP66aB4BQF7OoNMNL0TPCbGhEOATaYxI0CUzbFgPdnq',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'role_id' => 2,
            'name' => 'Christian',
            'email' => 'christian@f.uy',
            'password' => '$2y$10$2zWWsrgshwyP66aB4BQF7OoNMNL0TPCbGhEOATaYxI0CUzbFgPdnq',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
