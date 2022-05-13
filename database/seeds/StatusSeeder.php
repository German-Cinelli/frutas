<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'name' => 'Abierto',
            'description' => 'Pedido abierto.',
            'bg' => 'text-info'
        ]);

        DB::table('status')->insert([
            'name' => 'Cancelado',
            'description' => 'Pedido cancelado.',
            'bg' => 'text-danger'
        ]);

        DB::table('status')->insert([
            'name' => 'Pendiente',
            'description' => 'Pedido pendiente de pago.',
            'bg' => 'text-warning'
        ]);

        DB::table('status')->insert([
            'name' => 'Concretado',
            'description' => 'Pedido pago y cerrado.',
            'bg' => 'text-success'
        ]);

    }
}
