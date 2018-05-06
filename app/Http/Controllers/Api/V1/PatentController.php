<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\Patents\PatentListResource;
use App\Http\Resources\Patents\PatentResource;
use App\Http\Controllers\Controller;
use App\Repositories\Patent\PatentInterface;

class PatentController extends Controller
{
    use EsTrait;
    protected $recordRepository, $elasticSearchService;

    public function __construct(
        PatentInterface $patentRepository,
        ElasticSearchServiceInterface $elasticSearchService
    )
    {
        $this->recordRepository = $patentRepository;
        $this->elasticSearchService = $elasticSearchService;
    }

    public function index(Request $request)
    {
        $page = $request->get('page');
        $perPage = $request->get('per_page');
        $perPage = $perPage ? $perPage : 15;
        $queryString = $request->get('query');
        $base_technology_category_id = $request->get('base_technology_category_id');
        $patent_type_id = $request->get('patent_type_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('base_technology_category_id', 'patent_type_id'))
                ->paginate($perPage)->appends($request->query());
            $pages = $results->lastPage();
        } else {
            $fields = ['name', 'patent_code', 'owner', 'author', 'highlights', 'description'];
            $esPaginate = ['from' => ($page ? (integer)($page) - 1 : 0) * $perPage, 'size' => $perPage];
            $esResults = $this->elasticSearchService->search(
                'patents', 'patents', $queryString, $fields,
                compact('base_technology_category_id', 'patent_type_id'),
                $esPaginate
            );
            $results = $this->recordRepository->findInSet('id', $esResults['id'])->paginate($perPage, ['*'], 'page', 1)->appends($request->query());
            $results = $this->appendHighlightIntoResults($results, $esResults);
            $pages = ceil($esResults['total'] / $perPage);
        }
        return PatentListResource::collection($results)
            ->additional(compact('pages'))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $record = $this->recordRepository->find($id);
        return (new PatentResource($record))
            ->response()
            ->setStatusCode(200);
    }
}
