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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'specialization' => $this->specialization->name,
            'project_code' => $this->project_code,
            'author' => $this->author,
            'close_date' => $this->close_date
        ];
    }
}
