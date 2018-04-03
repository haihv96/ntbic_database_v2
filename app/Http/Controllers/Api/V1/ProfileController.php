<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use App\Repositories\Profile\ProfileInterface;

class ProfileController extends Controller
{
    protected $recordRepository, $elasticSearchService;

    public function __construct(
        ProfileInterface $profileRepository,
        ElasticSearchServiceInterface $elasticSearchService
    )
    {
        $this->recordRepository = $profileRepository;
        $this->elasticSearchService = $elasticSearchService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $academic_title_id = $request->get('academic_title_id');
        $province_id = $request->get('province_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('academic_title_id', 'province_id'))
                ->paginate($perPage);
        } else {
            $ids = $this->elasticSearchService->search(
                'profiles', 'profiles', $queryString, ['name'],
                compact('academic_title_id', 'province_id')
            );
            $results = $this->recordRepository->whereIn('id', $ids)->paginate($perPage);
        }
        return ProfileResource::collection($results)
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {

    }
}
