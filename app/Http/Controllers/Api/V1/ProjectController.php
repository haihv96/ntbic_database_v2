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
    use EsTrait;
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
        $page = $request->get('page');
        $perPage = $request->get('per_page');
        $perPage = $perPage ? $perPage : 15;
        $queryString = $request->get('query');
        $specialization_id = $request->get('specialization_id');
        $time = -microtime(true);
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('specialization_id'))
                ->paginate($perPage)->appends($request->query());
            $pages = $results->lastPage();
            $total = $results->total();
        } else {
            $fields = ['name', 'project_code', 'operator', 'author', 'highlights', 'description', 'results'];
            $esPaginate = ['from' => ($page ? (integer)($page) - 1 : 0) * $perPage, 'size' => $perPage];
            $esResults = $this->elasticSearchService->search(
                'projects', 'projects', $queryString, $fields,
                compact('specialization_id'), $esPaginate
            );
            $results = $this->recordRepository->findInSet('id', $esResults['id'])->paginate($perPage, ['*'], 'page', 1)->appends($request->query());
            $results = $this->appendHighlightIntoResults($results, $esResults);
            $pages = ceil($esResults['total'] / $perPage);
            $total = $esResults['total'];
        }
        $time += microtime(true);
        return ProjectListResource::collection($results)
            ->additional(compact('pages', 'total', 'time'))
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
