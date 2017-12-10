<?php

namespace App\Services\CrawlRequest;

interface CrawlRequestServiceInterface
{
    public function getXpath($url);

    public function responseFrom($url);

    public function saveImage($url, $directory);
}