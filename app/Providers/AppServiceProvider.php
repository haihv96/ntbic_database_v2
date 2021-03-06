<?php

namespace App\Providers;

use App;

use Illuminate\Support\ServiceProvider;

use App\Services\CrawlRequest\CrawlRequestServiceInterface;
use App\Services\CrawlRequest\CrawlRequestService;
use App\Services\ElasticSearch\ElasticSearchServiceInterface;
use App\Services\ElasticSearch\ElasticSearchService;
use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;
use App\Services\GuzzleHttp\AuthorizeRequestService;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\RawProject\RawProjectInterface;
use App\Repositories\RawProject\RawProjectRepository;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Repositories\RawProfile\RawProfileRepository;
use App\Repositories\RawPatent\RawPatentInterface;
use App\Repositories\RawPatent\RawPatentRepository;
use App\Repositories\RawProduct\RawProductInterface;
use App\Repositories\RawProduct\RawProductRepository;
use App\Repositories\RawCompany\RawCompanyInterface;
use App\Repositories\RawCompany\RawCompanyRepository;

use App\Repositories\Profile\ProfileInterface;
use App\Repositories\Profile\ProfileRepository;
use App\Repositories\Project\ProjectInterface;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Patent\PatentInterface;
use App\Repositories\Patent\PatentRepository;
use App\Repositories\Company\CompanyInterface;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Product\ProductRepository;

use App\Repositories\AcademicTitle\AcademicTitleInterface;
use App\Repositories\AcademicTitle\AcademicTitleRepository;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\Province\ProvinceRepository;
use App\Repositories\TechnologyCategory\TechnologyCategoryInterface;
use App\Repositories\TechnologyCategory\TechnologyCategoryRepository;
use App\Repositories\Specialization\SpecializationInterface;
use App\Repositories\Specialization\SpecializationRepository;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryInterface;
use App\Repositories\BaseTechnologyCategory\BaseTechnologyCategoryRepository;
use App\Repositories\PatentType\PatentTypeInterface;
use App\Repositories\PatentType\PatentTypeRepository;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind(CrawlRequestServiceInterface::class, CrawlRequestService::class);
        App::bind(ElasticSearchServiceInterface::class, ElasticSearchService::class);
        App::bind(AuthorizeRequestServiceInterface::class, AuthorizeRequestService::class);
        App::bind(UserInterface::class, UserRepository::class);
        App::bind(RawProductInterface::class, RawProductRepository::class);
        App::bind(RawProfileInterface::class, RawProfileRepository::class);
        App::bind(RawPatentInterface::class, RawPatentRepository::class);
        App::bind(RawProjectInterface::class, RawProjectRepository::class);
        App::bind(RawCompanyInterface::class, RawCompanyRepository::class);

        App::bind(ProfileInterface::class, ProfileRepository::class);
        App::bind(PatentInterface::class, PatentRepository::class);
        App::bind(ProjectInterface::class, ProjectRepository::class);
        App::bind(ProductInterface::class, ProductRepository::class);
        App::bind(CompanyInterface::class, CompanyRepository::class);

        App::bind(AcademicTitleInterface::class, AcademicTitleRepository::class);
        App::bind(ProvinceInterface::class, ProvinceRepository::class);
        App::bind(TechnologyCategoryInterface::class, TechnologyCategoryRepository::class);
        App::bind(SpecializationInterface::class, SpecializationRepository::class);
        App::bind(BaseTechnologyCategoryInterface::class, BaseTechnologyCategoryRepository::class);
        App::bind(PatentTypeInterface::class, PatentTypeRepository::class);
    }
}
