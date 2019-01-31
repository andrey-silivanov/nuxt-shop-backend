<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 17.01.19
 * Time: 14:02
 */

namespace App\Services\ImportProduct\EndorPhone;


use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\PhoneModels;
use App\Models\Product;
use App\Models\Tag;

class ImportService
{
    public function run()
    {
        $m = memory_get_usage();
        $filePath = storage_path() . "/app/test.csv"; /// opencart
        $row = 1;
        $result = [];
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 10000, ";")) !== FALSE) {
               // dd($data);
                if ($row === 1) {
                    $keys = $data;
                    array_pop($keys);
                     //dd($keys);
                } else {
                    //array_pop($data);
                    //dd($data);
                  //  try {
                        $result = array_combine($keys, $data);
                        //if ($result['Материал'] == 'Силикон') dd($result);
                        dd($result);
                        $brand = $result['Совместимость с телефоном'];
                        $model = $result['Модель телефона'];
                        $color = $result['Цвет'];
                        $material = $result['Материал'];
                        $category = $result['Категория дизайна'];
                        $tag = ucfirst($result['Тег']);
                    try {
                    $brand = Brand::firstOrCreate(['name' => $brand], ['name' => $brand]);
                    $model =  PhoneModels::firstOrCreate(['name' => $model, 'brand_id' => $brand->getKey()], ['name' => $model]);
                    if ($color !== '') {
                        $color = Color::firstOrCreate(['name' => $color], ['name' => $color, 'type' => $result['Особенность цвета']] );
                        $colorId = $color->getKey();
                    } else {
                        $colorId = null;
                    }

                    $material = Material::firstOrCreate(['name' => $material], ['name' => $material]);
                    $category = Category::firstOrCreate(['name' => $category], ['name' => $category]);
                    $tag = Tag::firstOrCreate(['name' => $tag], ['name' => $tag]);

                    Product::updateOrCreate([
                        'sku' => $result["﻿Артикул"],
                        'phone_model_id' => $model->getKey(),
                        'name' => $result['Название товара'],
                        'title' => $result['Название дизайна'],
                        'description' => $result['Описание'],
                        'price' => $result['Цена'],
                        'quantity' => $result['Остаток'],
                        'color_id' => $colorId,
                        'brand_id' => $brand->getKey(),
                        'category_id' => $category->getKey(),
                        'picture' => $result['Фото'],
                        'material_id' => $material->getKey(),
                        'tag_id' => $tag->getKey()
                    ], ['sku' => $result["﻿Артикул"]]);
                    } catch (\Exception $e) {
                        echo $e->getMessage();
                        dd($row);
                    }
                        //echo count($result) . " -> count";
                   /* } catch (\Exception $e) {
                        dd($row);
                    }*/

                }

                echo count($result);



                // dd($keys);
                //  echo $data[$c] . "<br />\n";
                //  }
                echo "\n" .$row . " => row \n";
                echo "mem -> ";
                echo memory_get_usage() - $m;
                $row++;
                // if(count($result) > 10) dd($result);
            }
            fclose($handle);
        }
        echo "End \n";
        echo count($result) . "\n";
    }
}