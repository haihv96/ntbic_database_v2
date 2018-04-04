<?php

namespace App\Http\Resources\Profiles;

use Illuminate\Http\Resources\Json\Resource;

class ProfileListResource extends Resource
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
            'name' => $this->name,
            'academic_title' => $this->academicTitle->name,
            'image' => $media ? $media : 'images/anon_user.png',
            'agency' => $this->agency,
            'birthday' => $this->birthday,
            'research_for' => $this->research_for
        ];
    }
}
