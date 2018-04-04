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
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $base_technology_category_id = $request->get('base_technology_category_id');
        $province_id = $request->get('province_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('base_technology_category_id', 'province_id'));
        } else {
            $ids = $this->elasticSearchService->search(
                'companies', 'companies', $queryString, ['name'],
                compact('base_technology_category_id', 'province_id')
            );
            $results = $this->recordRepository->whereIn('id', $ids);
        }
        return CompanyListResource::collection($results->paginate($perPage))
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
