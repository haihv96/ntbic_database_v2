<?php

namespace App\Repositories\Project;

use DB;
use App\Repositories\BaseRepository;
use App\Models\Project;

class ProjectRepository extends BaseRepository implements ProjectInterface
{
    public function __construct(Project $project)
    {
        parent::__construct($project);
    }


    public function indexQuery($search)
    {
        return $this->model
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.name', 'like', "%$search%");
    }

    public function showQuery($id)
    {
        return $this->model
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.id', $id)
            ->first();
    }

    public function updatedQuery($id)
    {
        return $this->model
            ->join('specializations', 'specializations.id', '=', 'projects.specialization_id')
            ->join('technology_categories', 'technology_categories.id', '=', 'specializations.technology_category_id')
            ->select(
                'projects.*',
                DB::raw('CONCAT(technology_categories.name," (",specializations.name,")") as specialization')
            )
            ->where('projects.id', $id)
            ->first();
    }

}