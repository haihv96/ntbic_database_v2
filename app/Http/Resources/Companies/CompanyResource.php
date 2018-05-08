<?php

namespace App\Http\Resources\Companies;

use Illuminate\Http\Resources\Json\Resource;

class CompanyResource extends Resource
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
            'logo' => url($media ? $media : 'images/no_logo.png'),
            'name' => $this->name,
            'last_update' => $this->last_update,
            'base_technology_category' => $this->baseTechnologyCategory->name,
            'province' => $this->province,
            'headquarters' => $this->headquarters,
            'email' => $this->email,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'website' => $this->website,
            'company_code' => $this->company_code,
            'tax_code' => $this->tax_code,
            'type' => $this->type,
            'founded' => $this->founded,
            'founder' => $this->founder,
            'founder_phone' => $this->founder_phone,
            'founder_email' => $this->founder_email,
            'founder_address' => $this->founder_address,
            'industry' => $this->industry,
            'tax_information' => $this->tax_information,
            'company_branch' => $this->company_branch,
            'representative_office' => $this->representative_office,
            'TRC_number' => $this->TRC_number,
            'TRC_date' => $this->TRC_date,
            'TRC_place' => $this->TRC_place,
            'technology_rank' => $this->technology_rank,
            'research_for' => $this->research_for,
            'number_of_employees_research' => $this->number_of_employees_research,
            'technology_highlight' => $this->technology_highlight,
            'technology_using' => $this->technology_using,
            'technology_transfer' => $this->technology_transfer,
            'results' => $this->results,
            'products' => $this->products
        ];
    }
}
