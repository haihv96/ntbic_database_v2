<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\BaseResource;
use App\Http\Controllers\Controller;

class BaseResourceController extends Controller
{
    protected $recordRepository;

    public function index()
    {
        if ($this->recordRepository) {
            return BaseResource::collection($this->recordRepository->all())
                ->response()
                ->setStatusCode(200);
        } else {
            return response()->json([
                'data' => null,
            ], 400);
        }
    }
}
