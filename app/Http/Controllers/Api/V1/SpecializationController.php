<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResource;
use App\Repositories\TechnologyCategory\TechnologyCategoryInterface;

class SpecializationController extends Controller
{
    protected $technologyCategoryRepository;

    public function __construct(
        TechnologyCategoryInterface $technologyCategoryRepository
    )
    {
        $this->technologyCategoryRepository = $technologyCategoryRepository;
    }

    public function index($technologyCategoryId)
    {
        if ($this->technologyCategoryRepository) {
            $records = $this->technologyCategoryRepository
                ->find($technologyCategoryId)
                ->specializations()
                ->get();
            return BaseResource::collection($records)
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json([
                'data' => null,
            ], 400);
        }
    }
}
