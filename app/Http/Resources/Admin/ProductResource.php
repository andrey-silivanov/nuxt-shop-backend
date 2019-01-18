<?php
declare(strict_types=1);

namespace App\Http\Resources\Admin;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ProductResource
 * @package App\Http\Resources\Admin
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /* @var  Product $this */
        return [
            'id'          => $this->getKey(),
            'name'        => $this->getAttribute('name'),
            'title'       => $this->getAttribute('title'),
            'description' => $this->getAttribute('description'),
            'picture'     => $this->getAttribute('picture'),
            'sku'         => $this->getAttribute('sku'),
            'color'       => $this->color->getAttribute('name'),
            'price'       => $this->getAttribute('price'),
            'brand'       => $this->brand->getAttribute('name'),
            'phoneModel'  => $this->phoneModel->getAttribute('name'),
            'category'    => $this->category->getAttribute('name'),
            'material'    => $this->material->getAttribute('name'),
            'show'        => $this->getAttribute('show')
        ];
    }
}
