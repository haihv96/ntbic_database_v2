<?php

namespace App\Http\Resources\Profiles;

use Illuminate\Http\Resources\Json\Resource;

class ProfileResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $media = $this->getFirstMediaUrl('avatar');
        return [
            'id' => $this->id,
            'image' => url($media ? $media : 'images/anon_user.png'),
            'name' => $this->name,
            'academic_title' => $this->academicTitle->name,
            'agency' => $this->agency,
            'birthday' => $this->birthday,
            'research_for' => $this->research_for,
            'studies_or_papers' => $this->studies_or_papers,
            'province' => $this->province,
            'specialization' => $this->specialization,
            'agency_address' => $this->agency_address,
            'research_joined' => $this->research_joined,
            'research_results' => $this->research_results,
        ];
    }
}
