<?php

namespace App\Services\CrawlRequest;

use DOMDocument;
use DOMXPath;

class CrawlRequestService implements CrawlRequestServiceInterface
{

    public function getXpath($url)
    {
        $doc = new DOMDocument();
        $source = $this->responseFrom($url);
        @$doc->loadHTML($source);
        $xpath = new DOMXPath($doc);
        return $xpath;
    }

    public function responseFrom($url)
    {
        $ch = curl_init();
        $headers = [
            'User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.1547.66 Safari/537.36',
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function saveImage($url, $directory)
    {

        $content = @file_get_contents($url);
        $fp = fopen($directory, "w");
        fwrite($fp, $content);
        fclose($fp);

    }
}