<?php

namespace App\Http\Resources\Admin;

use App\Models\PhoneModels;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var PhoneModels $this */
        return [
            'id' => $this->getKey(),
            'name' => $this->getAttribute('name')
        ];
    }
}
