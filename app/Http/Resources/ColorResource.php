<?php

namespace App\Http\Resources;

use App\Models\Color;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request):array
    {
        /* @var Color $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->getAttribute('name'),
            'hex' => $this->getAttribute('hex')
        ];
    }
}
