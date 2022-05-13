<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Acelga',
            'image' => '/assets/images/products/acelga.png',
            'slug' => 'acelga',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Ají',
            'image' => '/assets/images/products/aji.jpg',
            'slug' => 'aji',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Ajo',
            'image' => '/assets/images/products/ajo.jpg',
            'slug' => 'ajo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Apio',
            'image' => '/assets/images/products/apio.png',
            'slug' => 'apio',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Arándano',
            'image' => '/assets/images/products/arandano.png',
            'slug' => 'arandano',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Banana',
            'image' => '/assets/images/products/banana.jpg',
            'slug' => 'banana',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Berenjena',
            'image' => '/assets/images/products/berenjena.jpg',
            'slug' => 'berenjena',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Brócoli',
            'image' => '/assets/images/products/brocoli.jpg',
            'slug' => 'brocoli',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Cabutia',
            'image' => '/assets/images/products/cabutia.jpg',
            'slug' => 'cabutia',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Calabacín',
            'image' => '/assets/images/products/calabacin.jpg',
            'slug' => 'calabacin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Cebolla',
            'image' => '/assets/images/products/cebolla.png',
            'slug' => 'cebolla',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Cebolla morada',
            'image' => '/assets/images/products/cebolla-2.jpg',
            'slug' => 'cebolla-morada',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Cereza',
            'image' => '/assets/images/products/cereza.png',
            'slug' => 'cereza',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Cherry',
            'image' => '/assets/images/products/cherry.jpg',
            'slug' => 'cherri',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Choclo',
            'image' => '/assets/images/products/choclo.jpg',
            'slug' => 'choclo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Ciruela',
            'image' => '/assets/images/products/ciruela.jpg',
            'slug' => 'ciruela',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Coco',
            'image' => '/assets/images/products/coco.jpg',
            'slug' => 'coco',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Coliflor',
            'image' => '/assets/images/products/coliflor.jpg',
            'slug' => 'coliflor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Damasco',
            'image' => '/assets/images/products/damasco.jpg',
            'slug' => 'damasco',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Durazno',
            'image' => '/assets/images/products/durazno.jpg',
            'slug' => 'durazno',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Espárrago',
            'image' => '/assets/images/products/esparrago.jpg',
            'slug' => 'esparrago',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Espinaca',
            'image' => '/assets/images/products/espinaca.jpg',
            'slug' => 'espinaca',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Frambuesa',
            'image' => '/assets/images/products/frambuesa.png',
            'slug' => 'frambuesa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Frutilla',
            'image' => '/assets/images/products/frutilla.png',
            'slug' => 'frutilla',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Granada',
            'image' => '/assets/images/products/granada.jpg',
            'slug' => 'granada',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Higo',
            'image' => '/assets/images/products/higo.png',
            'slug' => 'higo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Kiwi',
            'image' => '/assets/images/products/kiwi.jpg',
            'slug' => 'kiwi',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Lechuga',
            'image' => '/assets/images/products/lechuga.jpg',
            'slug' => 'lechuga',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Lima',
            'image' => '/assets/images/products/lima.png',
            'slug' => 'lima',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Limón',
            'image' => '/assets/images/products/limon.jpg',
            'slug' => 'limon',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Mandarina',
            'image' => '/assets/images/products/mandarina.jpg',
            'slug' => 'mandarina',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Mango',
            'image' => '/assets/images/products/mango.jpg',
            'slug' => 'mango',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Manzana',
            'image' => '/assets/images/products/manzana.png',
            'slug' => 'manzana',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Manzana verde',
            'image' => '/assets/images/products/manzana-verde.png',
            'slug' => 'manznaa-verde',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Maracuyá',
            'image' => '/assets/images/products/maracuya.jpg',
            'slug' => 'maracuya',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Melón',
            'image' => '/assets/images/products/melon.png',
            'slug' => 'melon',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Morrón rojo',
            'image' => '/assets/images/products/morron-rojo.jpg',
            'slug' => 'morron-rojo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Morrón verde',
            'image' => '/assets/images/products/morron-verde.jpg',
            'slug' => 'morron-verde',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Naranja',
            'image' => '/assets/images/products/naranja.jpg',
            'slug' => 'naranja',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Palta',
            'image' => '/assets/images/products/palta.png',
            'slug' => 'palta',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Papa',
            'image' => '/assets/images/products/papa.jpg',
            'slug' => 'papa',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Papa blanca',
            'image' => '/assets/images/products/papa-blanca.jpg',
            'slug' => 'papa-blanca',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Papaya',
            'image' => '/assets/images/products/papaya.jpg',
            'slug' => 'papaya',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Pelón',
            'image' => '/assets/images/products/pelon.jpg',
            'slug' => 'pelon',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Pepino',
            'image' => '/assets/images/products/pepino.jpg',
            'slug' => 'pepino',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Pera',
            'image' => '/assets/images/products/pera.jpg',
            'slug' => 'pera',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Piña',
            'image' => '/assets/images/products/piña.jpg',
            'slug' => 'pina',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Pomelo',
            'image' => '/assets/images/products/pomelo.png',
            'slug' => 'pomelo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Remolacha',
            'image' => '/assets/images/products/remolacha.png',
            'slug' => 'remolacha',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Repollo',
            'image' => '/assets/images/products/repollo.jpg',
            'slug' => 'repollo',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Sandía',
            'image' => '/assets/images/products/sandia.jpg',
            'slug' => 'sandia',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Tomate',
            'image' => '/assets/images/products/tomate.png',
            'slug' => 'tomate',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Uva',
            'image' => '/assets/images/products/uva.jpg',
            'slug' => 'uva',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Uva verde',
            'image' => '/assets/images/products/uva-verde.jpg',
            'slug' => 'uva-verde',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('products')->insert([
            'category_id' => 1,
            'name' => 'Zanahoria',
            'image' => '/assets/images/products/zanahoria.jpg',
            'slug' => 'zanahoria',
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
