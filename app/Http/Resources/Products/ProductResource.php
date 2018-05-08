<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
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
            'thumb' => url($media ? $media : 'images/nophoto.jpg'),
            'name' => $this->name,
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'highlights' => $this->highlights,
            'description' => $this->description,
            'transfer_description' => $this->transfer_description,
            'results' => $this->results
        ];
    }
}
