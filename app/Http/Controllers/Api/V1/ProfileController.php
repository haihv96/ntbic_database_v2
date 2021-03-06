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
    use EsTrait;
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
        $page = $request->get('page');
        $perPage = $request->get('per_page');
        $perPage = $perPage ? $perPage : 15;
        $queryString = $request->get('query');
        $academic_title_id = $request->get('academic_title_id');
        $province_id = $request->get('province_id');
        $time = -microtime(true);
        if (empty($queryString)) {
            $results = $this->recordRepository
                ->filters(compact('academic_title_id', 'province_id'))
                ->paginate($perPage)->appends($request->query());
            $pages = $results->lastPage();
            $total = $results->total();
        } else {
            $fields = ['name', 'research_for', 'specialization', 'agency', 'research_joined', 'research_results'];
            $esPaginate = ['from' => ($page ? (integer)($page) - 1 : 0) * $perPage, 'size' => $perPage];
            $esResults = $this->elasticSearchService->search(
                'profiles', 'profiles', $queryString, $fields,
                compact('academic_title_id', 'province_id'), $esPaginate
            );
            $results = $this->recordRepository->findInSet('id', $esResults['id'])->paginate($perPage, ['*'], 'page', 1)->appends($request->query());
            $results = $this->appendHighlightIntoResults($results, $esResults);
            $pages = ceil($esResults['total'] / $perPage);
            $total = $esResults['total'];
        }
        $time += microtime(true);
        return ProfileListResource::collection($results)
            ->additional(compact('pages', 'total', 'time'))
            ->response()
            ->setStatusCode(200);
    }

    public function show($id)
    {
        sleep(1);
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
