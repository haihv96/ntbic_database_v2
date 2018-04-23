<?php

namespace App\Http\Resources\Patents;

use Illuminate\Http\Resources\Json\Resource;

class PatentListResource extends Resource
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
            'id' => $this->id,
            'name' => $this->name,
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'patent_code' => $this->patent_code,
            'author' => $this->author,
            'public_date' => $this->public_date
        ];
    }
}
