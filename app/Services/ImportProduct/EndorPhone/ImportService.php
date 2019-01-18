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
                if ($row === 1) {
                    $keys = $data;
                    array_pop($keys);
                    // dd($keys);
                } else {
                   // dd($data);
                  //  try {
                        $result = array_combine($keys, $data);
                      //  dd($result["﻿Артикул"]);

                        $brand = $result['Совместимость с телефоном'];
                        $model = $result['Модель телефона'];
                        $color = $result['Цвет'];
                        $material = $result['Материал'];
                        $category = $result['Категория дизайна'];
                    try {
                    $brand = Brand::firstOrCreate(['name' => $brand], ['name' => $brand]);
                    $model =  PhoneModels::firstOrCreate(['name' => $model, 'brand_id' => $brand->getKey()], ['name' => $model]);
                    $color = Color::firstOrCreate(['name' => $color, 'type' => $result['Особенность цвета']], ['name' => $color]);
                    $material = Material::firstOrCreate(['name' => $material], ['name' => $material]);
                    $category = Category::firstOrCreate(['name' => $category], ['name' => $category]);

                    Product::updateOrCreate([
                        'sku' => $result["﻿Артикул"],
                        'phone_model_id' => $model->getKey(),
                        'name' => $result['Название товара'],
                        'title' => $result['Название дизайна'],
                        'description' => $result['Описание'],
                        'price' => $result['Цена'],
                        'quantity' => $result['Остаток'],
                        'color_id' => $color->getKey(),
                        'brand_id' => $brand->getKey(),
                        'category_id' => $category->getKey(),
                        'picture' => $result['Фото'],
                        'material_id' => $material->getKey()
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