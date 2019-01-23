<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var Product $this */
        return [
            'id'          => $this->getKey(),
            'title'       => $this->getAttribute('title'),
            'name'        => $this->getAttribute('name'),
            'description' => $this->getAttribute('description'),
            'image'       => asset($this->getAttribute('picture')),
            'price'       => $this->getAttribute('price')
        ];
    }
}
