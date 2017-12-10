<?php

namespace App\Providers;
use App;

use Illuminate\Support\ServiceProvider;

use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;

use App\Services\CrawlRequest\CrawlRequestServiceInterface;
use App\Services\CrawlRequest\CrawlRequestService;


class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {

    }

    public function register()
    {
        App::bind(CrawlRequestServiceInterface::class, CrawlRequestService::class);
    }
}
