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
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $base_technology_category_id = $request->get('base_technology_category_id');
        $patent_type_id = $request->get('patent_type_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('base_technology_category_id', 'patent_type_id'));
        } else {
            $fields = [
                'vi' => ['name.vi', 'patent_code.vi', 'owner.vi', 'author.vi', 'highlights.vi', 'description.vi', 'market_application.vi'],
                'en' => ['name.en', 'patent_code.en', 'owner.en', 'author.en', 'highlights.en', 'description.en', 'market_application.en']
            ];
            $ids = $this->elasticSearchService->search(
                'patents', 'patents', $queryString, $fields,
                compact('base_technology_category_id', 'patent_type_id')
            );
            $results = $this->recordRepository->findInSet('id', $ids);
        }
        return PatentListResource::collection($results->paginate($perPage)->appends($request->query()))
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
