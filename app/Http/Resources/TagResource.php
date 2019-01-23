<?php
declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Tag,
    Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TagResource
 * @package App\Http\Resources
 */
class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /* @var Tag $this */
        return [
            'id'   => $this->getKey(),
            'name' => $this->getAttribute('name')
        ];
    }
}
