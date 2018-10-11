<?php

namespace App\Http\Resources;

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
        return [
            'id'          => $this->getKey(),
            'title'       => $this->title,
            'description' => $this->description,
            'image'       => asset($this->getFirstMediaUrl('products')),
            'price'       => $this->price
        ];
    }
}
