<?php

namespace App\Repositories\Project;

interface ProjectInterface
{
    public function indexQuery($search);

    public function showQuery($id);

    public function updatedQuery($id);

    public function baseAnalysis();
}
