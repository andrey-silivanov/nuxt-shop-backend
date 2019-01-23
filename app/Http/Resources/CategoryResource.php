<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Category,
    Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryResource
 * @package App\Http\Resources
 */
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request):array
    {
        /* @var Category $this */
        return [
            'id'   => $this->getKey(),
            'name' => $this->getAttribute('name'),
        ];
    }
}
