<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\Resource;

class CompanyListResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $media = $this->getFirstMediaUrl('logo');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => url($media ? $media : 'images/no_logo.png'),
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'province' => $this->province->name,
            'headquarters' => $this->headquarters
        ];
    }
}
