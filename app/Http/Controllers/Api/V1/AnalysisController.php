<?php

namespace App\Http\Controllers\Api\V1;

use App\Repositories\Profile\ProfileInterface;
use App\Repositories\Project\ProjectInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Patent\PatentInterface;
use App\Repositories\Company\CompanyInterface;
use App\Http\Controllers\Controller;

class AnalysisController extends Controller
{
    protected
        $profileRepository,
        $projectRepository,
        $productRepository,
        $patentRepository,
        $companyRepository;

    public function __construct(
        ProfileInterface $profileRepository,
        ProjectInterface $projectRepository,
        ProductInterface $productRepository,
        PatentInterface $patentRepository,
        CompanyInterface $companyRepository
    )
    {
        $this->profileRepository = $profileRepository;
        $this->projectRepository = $projectRepository;
        $this->productRepository = $productRepository;
        $this->patentRepository = $patentRepository;
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => [
                'profiles' => $this->profileRepository->baseAnalysis()->toArray(),
                'patents' => $this->patentRepository->baseAnalysis()->toArray(),
                'products' => $this->productRepository->baseAnalysis()->toArray(),
                'projects' => $this->projectRepository->baseAnalysis()->toArray(),
                'companies' => $this->companyRepository->baseAnalysis()->toArray()
            ]
        ], 200);
    }
}
