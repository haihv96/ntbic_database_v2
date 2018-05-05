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
            $fields = [
                'vi' => ['name.vi', 'project_code.vi', 'operator.vi', 'author.vi', 'highlights.vi', 'description.vi', 'results.vi'],
                'en' => ['name.en', 'project_code.en', 'operator.en', 'author.en', 'highlights.en', 'description.en', 'results.en']
            ];
            $ids = $this->elasticSearchService->search(
                'projects', 'projects', $queryString, $fields,
                compact('specialization_id')
            );
            $results = $this->recordRepository->findInSet('id', $ids);
        }
        return ProjectListResource::collection($results->paginate($perPage)->appends($request->query()))
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
