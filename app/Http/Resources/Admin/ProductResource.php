<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mainProduct = $this->products->first();
        $data = $this->getParams();

        return [
            'name' => $mainProduct->name,
            'picture' => $mainProduct->picture,
            'sizes' => implode(', ', $data['size']),
            'color' => implode(', ', $data['color'])
        ];
    }

    private function getParams()
    {
        $data = [];
        foreach ($this->products as $product) {
            $data['size'][] = $product->size;
            $data['color'][] = $product->color;
        }

        return $data;
    }
}
