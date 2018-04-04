<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\Projects\ProjectListResource;
use App\Http\Resources\Projects\ProjectResource;
use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectInterface;

class ProjectController extends Controller
{
    protected $recordRepository, $elasticSearchService;

    public function __construct(
        ProjectInterface $projectRepository,
        ElasticSearchServiceInterface $elasticSearchService
    )
    {
        $this->recordRepository = $projectRepository;
        $this->elasticSearchService = $elasticSearchService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $specialization_id = $request->get('specialization_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('specialization_id'));
        } else {
            $ids = $this->elasticSearchService->search(
                'projects', 'projects', $queryString, ['name'],
                compact('specialization_id')
            );
            $results = $this->recordRepository->whereIn('id', $ids);
        }
        return ProjectListResource::collection($results->paginate($perPage))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $record = $this->recordRepository->showQuery($id);
        return (new ProjectResource($record))
            ->response()
            ->setStatusCode(200);
    }
}
