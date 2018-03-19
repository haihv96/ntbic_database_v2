<?php

namespace App\Repositories\Project;

use App\Repositories\BaseRepository;
use App\Models\Project;

class ProjectRepository extends BaseRepository implements ProjectInterface
{
    public function __construct(Project $project)
    {
        parent::__construct($project);
    }
}