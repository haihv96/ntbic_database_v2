<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\Companies\CompanyListResource;
use App\Http\Resources\Companies\CompanyResource;
use App\Http\Controllers\Controller;
use App\Repositories\Company\CompanyInterface;

class CompanyController extends Controller
{
    use EsTrait;
    protected $recordRepository, $elasticSearchService;

    public function __construct(
        CompanyInterface $companyRepository,
        ElasticSearchServiceInterface $elasticSearchService
    )
    {
        $this->recordRepository = $companyRepository;
        $this->elasticSearchService = $elasticSearchService;
    }

    public function index(Request $request)
    {
        $page = $request->get('page');
        $perPage = $request->get('per_page');
        $perPage = $perPage ? $perPage : 15;
        $queryString = $request->get('query');
        $base_technology_category_id = $request->get('base_technology_category_id');
        $province_id = $request->get('province_id');
        $time = -microtime(true);
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('base_technology_category_id', 'province_id'))
                ->paginate($perPage)->appends($request->query());
            $pages = $results->lastPage();
            $total = $results->total();
        } else {
            $fields = ['name', 'headquarters', 'company_code', 'founder', 'industry',
                'research_for', 'technology_highlight', 'technology_using',
                'results', 'products'
            ];
            $esPaginate = ['from' => ($page ? (integer)($page) - 1 : 0) * $perPage, 'size' => $perPage];
            $esResults = $this->elasticSearchService->search(
                'companies', 'companies', $queryString, $fields,
                compact('base_technology_category_id', 'province_id'),
                $esPaginate
            );
            $results = $this->recordRepository->findInSet('id', $esResults['id'])->paginate($perPage, ['*'], 'page', 1)->appends($request->query());
            $results = $this->appendHighlightIntoResults($results, $esResults);
            $pages = ceil($esResults['total'] / $perPage);
            $total = $esResults['total'];
        }
        $time += microtime(true);
        return CompanyListResource::collection($results)
            ->additional(compact('pages', 'total', 'time'))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $record = $this->recordRepository->showQuery($id);
        return (new CompanyResource($record))
            ->response()
            ->setStatusCode(200);
    }
}
