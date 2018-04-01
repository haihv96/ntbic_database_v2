<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use App\Repositories\Profile\ProfileInterface;
use Elasticsearch\ClientBuilder;

class ProfileController extends Controller
{
    protected $recordRepository;

    public function __construct(ProfileInterface $profileRepository)
    {
        $this->recordRepository = $profileRepository;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page');
        $queryString = $request->get('query');
        $academicTitle = $request->get('academic_title');
        $province = $request->get('province');
        $params = [
            'index' => 'profiles',
            'type' => 'profiles',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            'match' => [
                                'highlights' => [
                                    'query' => $queryString || '',
                                    'operator' => 'and',
                                ]
                            ]
                        ]
                    ],
                ],
            ]
        ];

        $results = ClientBuilder::create()->build()->search($params);
        dd($results);
        $records = $this->recordRepository->paginate($perPage);
        return ProfileResource::collection($records)
            ->response()
            ->setStatusCode(200);
    }
}
