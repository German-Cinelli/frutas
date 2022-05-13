<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Mario',
            'email' => 'mario@f.uy',
            'password' => '$2y$10$jQePMf7O64YdSVmJgD3aH.b0w6bknFxhJpCttDUJRNWJglBxgftWG',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
