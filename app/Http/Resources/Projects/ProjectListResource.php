<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\Resource;

class ProjectListResource extends Resource
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
            'specialization' => $this->specialization->name,
            'author' => $this->author,
        ];
        foreach (['description', 'highlights', 'results', 'operator'] as $attr) {
            if (is_array($this->{$attr})) {
                $result[$attr] = $this->{$attr};
            }
        }
        return $result;
    }
}
