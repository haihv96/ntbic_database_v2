<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\Profiles\ProfileListResource;
use App\Http\Resources\Profiles\ProfileResource;
use App\Http\Resources\Profiles\BaseInfoProfileResource;
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
                ->filters(compact('academic_title_id', 'province_id'));
        } else {
            $ids = $this->elasticSearchService->search(
                'profiles', 'profiles', $queryString, ['name', 'research_for', 'agency'],
                compact('academic_title_id', 'province_id')
            );
            $results = $this->recordRepository->whereIn('id', $ids);
        }
        return ProfileListResource::collection($results->paginate($perPage)->appends($request->query()))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $record = $this->recordRepository->showQuery($id);
        return (new ProfileResource($record))
            ->response()
            ->setStatusCode(200);
    }

    public function getTop(Request $request)
    {
        $limit = $request->get('limit');
        $record = $this->recordRepository->getTop((int)$limit);
        return BaseInfoProfileResource::collection($record)
            ->response()
            ->setStatusCode(200);
    }
}
