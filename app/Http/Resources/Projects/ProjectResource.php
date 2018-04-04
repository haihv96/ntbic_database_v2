<?php

namespace App\Http\Resources\Projects;

use Illuminate\Http\Resources\Json\Resource;

class ProjectResource extends Resource
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
            'project_code' => $this->project_code,
            'specialization' => $this->specialization,
            'start_date_invest' => $this->start_date_invest,
            'close_date' => $this->close_date,
            'operator' => $this->operator,
            'author' => $this->author,
            'highlights' => $this->highlights,
            'description' => $this->description,
            'transfer_description' => $this->transfer_description,
            'results' => $this->results
        ];
    }
}
