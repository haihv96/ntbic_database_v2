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
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => url($media ? $media : 'images/no_logo.png'),
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'founder' => $this->founder,
            'industry' => $this->industry,
        ];

        foreach (['headquarters', 'company_code', 'founder', 'industry', 'research_for',
                     'technology_highlight', 'technology_using', 'results', 'products'] as $attr) {
            if (is_array($this->{$attr})) {
                $result[$attr] = $this->{$attr};
            }
        }
        return $result;
    }
}
