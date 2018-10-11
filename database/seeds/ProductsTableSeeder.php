<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsImage = [
            'resources/shop/seeder_image/product-01.jpg',
            'resources/shop/seeder_image/product-02.jpg',
            'resources/shop/seeder_image/product-03.jpg',
            'resources/shop/seeder_image/product-04.jpg',
            'resources/shop/seeder_image/product-05.jpg',
            'resources/shop/seeder_image/product-06.jpg',
            'resources/shop/seeder_image/product-07.jpg',
            'resources/shop/seeder_image/product-08.jpg',
            'resources/shop/seeder_image/product-09.jpg',
            'resources/shop/seeder_image/product-10.jpg',
            'resources/shop/seeder_image/product-11.jpg',
            'resources/shop/seeder_image/product-12.jpg',
            'resources/shop/seeder_image/product-13.jpg',
            'resources/shop/seeder_image/product-14.jpg',
            'resources/shop/seeder_image/product-15.jpg',
            'resources/shop/seeder_image/product-16.jpg',
        ];

        foreach ($productsImage as $image) {
            $product = factory(App\Models\Product::class)->create();
            $product->addMedia($image)->preservingOriginal()->toMediaCollection('products');
        }
    }
}
