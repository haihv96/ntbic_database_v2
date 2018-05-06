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
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'thumb' => url($media ? $media : 'images/nophoto.jpg'),
            'base_technology_category' => $this->baseTechnologyCategory->name,
        ];
        foreach (['highlights', 'description', 'results'] as $attr) {
            if (is_array($this->{$attr})) {
                $result[$attr] = $this->{$attr};
            }
        }
        return $result;
    }
}
