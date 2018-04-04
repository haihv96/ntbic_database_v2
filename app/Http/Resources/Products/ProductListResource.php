<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\Resource;

class ProductListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $media = $this->getFirstMediaUrl('thumb');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'thumb' => $media ? $media : 'images/nophoto.jpg',
            'technology_category' => $this->baseTechnologyCategory->name,
            'highlights' => $this->hightlights
        ];
    }
}
