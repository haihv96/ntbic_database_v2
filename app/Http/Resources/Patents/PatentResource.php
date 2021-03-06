<?php

namespace App\Http\Resources\Patents;

use Illuminate\Http\Resources\Json\Resource;

class PatentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $media = $this->getFirstMediaUrl('image');
        return [
            'id' => $this->id,
            'image' => url($media ? $media : 'images/nophoto.jpg'),
            'name' => $this->name,
            'patent_code' => $this->patent_code,
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'patent_type' => $this->patentType->name,
            'public_date' => $this->public_date,
            'provide_date' => $this->provide_date,
            'owner' => $this->owner,
            'author' => $this->author,
            'highlights' => $this->highlights,
            'description' => $this->description,
            'content_can_be_transferred' => $this->content_can_be_transferred,
            'market_application' => $this->market_application
        ];
    }
}
