<?php

use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'name' => 'Contado'
        ]);

        DB::table('payment_types')->insert([
            'name' => 'Crédito'
        ]);
    }
}
