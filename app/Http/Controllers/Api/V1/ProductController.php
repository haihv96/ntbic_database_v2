<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Http\Resources\Products\ProductListResource;
use App\Http\Resources\Products\ProductResource;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductInterface;

class ProductController extends Controller
{
    protected $recordRepository, $elasticSearchService;

    public function __construct(
        ProductInterface $productRepository,
        ElasticSearchServiceInterface $elasticSearchService
    )
    {
        $this->recordRepository = $productRepository;
        $this->elasticSearchService = $elasticSearchService;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $base_technology_category_id = $request->get('base_technology_category_id');
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('base_technology_category_id'));
        } else {
            $fields = [
                'vi' => ['name.vi', 'highlights.vi', 'description.vi', 'results.vi'],
                'en' => ['name.en', 'highlights.en', 'description.en', 'results.en'],
            ];
            $ids = $this->elasticSearchService->search(
                'products', 'products', $queryString, $fields,
                compact('base_technology_category_id')
            );
            $results = $this->recordRepository->findInSet('id', $ids);
        }
        return ProductListResource::collection($results->paginate($perPage)->appends($request->query()))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        $record = $this->recordRepository->showQuery($id);
        return (new ProductResource($record))
            ->response()
            ->setStatusCode(200);
    }
}
