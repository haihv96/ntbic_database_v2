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
        $result = [
            'id' => $this->id,
            'name' => $this->name,
            'academic_title' => $this->academicTitle->name,
            'image' => url($media ? $media : 'images/anon_user.png'),
            'agency' => $this->agency,
        ];
        foreach (['specialization', 'agency', 'research_for',
                     'research_joined', 'research_results'] as $attr) {
            if (is_array($this->{$attr})) {
                $result[$attr] = $this->{$attr};
            }
        }
        return $result;
    }
}
