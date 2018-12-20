<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'    => $this->id,
            'name'  => $this->name,
            'test'  => 'asada',
            'test1' => 'asada',
            'test2' => "<button class='md-button md-raised md-primary md-theme-demo-light'>
                         <div class='md-ripple'>
                                <div class='md-button-content'>
                                Test2
                                </div>
                            </div>
                        </button>",
        ];
    }
}
