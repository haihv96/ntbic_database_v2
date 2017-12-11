<?php

namespace App\Providers;

use App;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Services\CrawlRequest\CrawlRequestServiceInterface;
use App\Services\CrawlRequest\CrawlRequestService;

use App\Services\GuzzleHttp\AuthorizeRequestServiceInterface;
use App\Services\GuzzleHttp\AuthorizeRequestService;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind(CrawlRequestServiceInterface::class, CrawlRequestService::class);
        App::bind(AuthorizeRequestServiceInterface::class, AuthorizeRequestService::class);
    }
}
