<?php

namespace App\Repositories\AcademicTitle;

use App\Repositories\BaseRepository;
use App\Models\AcademicTitle;

class AcademicTitleRepository extends BaseRepository implements AcademicTitleInterface
{
    public function __construct(AcademicTitle $academicTitle)
    {
        parent::__construct($academicTitle);
    }
}