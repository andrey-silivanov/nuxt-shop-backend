<?php
declare(strict_types=1);

namespace App\Services\ImportProduct\TimeOfStyle;

use App\Models\Category;

/**
 * Class ImportProductService
 * @package App\Services\ImportProduct\TimeOfStyle
 */
class ImportProductService
{
    /**
     *
     */
    //const XML_URL = 'https://timeofstyle.com/standart_yml_catalog.xml';
    const XML_URL = 'https://timeofstyle.com/prom_yml_drop_catalog.xml';
    /**
     * @var \SimpleXMLElement
     */
    protected $file;

    /**
     * ImportProductService constructor.
     */
    public function __construct()
    {
        $this->file = simplexml_load_file(self::XML_URL);
    }

    /**
     *
     */
    public function run()
    {
        $this->saveCategories($this->categoriesParser());
        $this->saveProducts($this->productsParser());
    }

    /**
     * @return array
     */
    private function categoriesParser(): array
    {
        //dd($this->file);
        $result = [];
        foreach ($this->file->shop->categories->category as $category) {
            if ($category['parentId']) {
                $parent = strval($category['parentId']);
            }else{
                $parent = '0';
            }

            array_push($result, [
                'category_id' => strval($category['id']),
                'name' => strval($category['0']),
                'parent_id' => $parent
            ]);
        }

        return $result;
    }

    /**
     * @return array
     */
    private function productsParser(): array
    {
        $result = [];
        foreach ($this->file->shop->offers->offer as $offer) {
            foreach ($offer->param as $param) {
                if ($param['name'] == 'Цвет' ){
                    $color = $param;
                }
                if ($param['name'] == 'Размер') {
                    $size = $param;
                }
            }

            $productId = strval($offer['id']);

            if (strpos($productId, "|")) {
                $str = strpos($productId, "|");
                $productId = substr($productId, 0, $str);
            }

            array_push($result,[
                /// groups
                'groups' => [
                    'provider_id'  => $productId,
                    'provider_url' => strval($offer->url),
                    'category_id'  => strval($offer->categoryId),
                ],

                /// products
                'products' => [
                    'name' => strval($offer->name),
                    'sku' => strval($offer['id']),
                    'color' => $color ?? 'not color',
                    'description'=> strval($offer->description),
                    'provider_price'=> strval($offer->price),
                    'price' => 10000,
                    'picture' => strval($offer->picture[0]),
                    'quantity' => strval($offer->quantity),
                    'size' => $size ?? 99,
                    'available'=> (bool)strval($offer['available']),
                    'show' => true,
                ]
            ]);
        }

        return $result;
    }

    /**
     * @param array $categories
     */
    private function saveCategories(array $categories)
    {
        foreach ($categories as $category) {
            Category::updateOrCreate(['category_id' => $category['category_id']],$category);
        }
    }

    /**
     * @param array $products
     */
    private function saveProducts(array $products)
    {
        foreach ($products as $product) {
            $productGroup = \App\Models\ProductGroups::firstOrCreate(
                ['provider_id' => $product['groups']['provider_id']], $product['groups']);

            $productGroup->products()->updateOrCreate([
                'sku' => $product['products']['sku']
            ],$product['products']);
        }
    }
}