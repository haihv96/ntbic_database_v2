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
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'patent_code' => $this->patent_code,
            'owner' => $this->owner,

        ];
        foreach (['author', 'highlights', 'description'] as $attr) {
            if (is_array($this->{$attr})) {
                $result[$attr] = $this->{$attr};
            }
        }
        return $result;
    }
}
