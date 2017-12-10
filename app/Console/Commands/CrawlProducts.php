<?php

namespace App\Console\Commands;

use App\Models\RawProduct;
use Illuminate\Console\Command;
use App\Services\CrawlRequest\CrawlRequestServiceInterface;

class CrawlProducts extends Command
{
    protected $signature = 'crawl:products';
    protected $description = 'crawl products from khoahoctot.vn';
    protected $crawlRequestService;

    public function __construct(CrawlRequestServiceInterface $crawlRequestService)
    {
        parent::__construct();
        $this->crawlRequestService = $crawlRequestService;
    }

    public function handle()
    {
        $start = $this->crawlRequestService->getXpath('http://khoahoctot.vn/index.php?lg=vi&com=products&fun=search&q=');
        $pages = $start->query('(//div[@class="pages"]/a)[last()]')->item(0)->nodeValue * 15;
        for ($index = 0; $index <= $pages; $index += 15) {
            $url = "http://khoahoctot.vn/?com=products&fun=search&catid=0&fieldid=&disnt=&type=&rate=&transfer=&field=0&q=&page=$index";
            $this->parseProducts($url);
        }
    }

    protected function parseProducts($url)
    {
        $productsXpath = $this->crawlRequestService->getXpath($url);
        $products = $productsXpath->query('//*[@id="wrapper"]/div[4]/div[2]/table/tbody/tr');
        foreach ($products as $product) {
            $url = $productsXpath->query('./td[5]/a/@href', $product)->item(0)->nodeValue;
            $thumbPath = trim($productsXpath->query('./td[4]/img/@src', $product)->item(0)->nodeValue);
            if ($thumbPath != '/images/nophoto.jpg') {
                $thumb = 'public/crawl/products/thumb/' . last(explode('/', $thumbPath));
                $this->crawlRequestService->saveImage("http://khoahoctot.vn/$thumbPath", $thumb);
            } else {
                $thumb = null;
            }

            $productXpath = $this->crawlRequestService->getXpath($url);
            $body = $productXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table/tbody')->item(0);
            $name = $this->getContent($productXpath->query('./tr[1]/td', $body)->item(0));
            $technology_category = $this->getContent($productXpath->query('./tr[2]/td', $body)->item(0));
            $highlights = convertHtmlToText($productXpath->query('./tr[3]/td/div[2]', $body)->item(0));
            $description = convertHtmlToText($productXpath->query('./tr[4]/td/div[2]', $body)->item(0));
            $transfer_description = convertHtmlToText($productXpath->query('./tr[5]/td/div[2]', $body)->item(0));
            $results = convertHtmlToText($productXpath->query('./tr[6]/td/div[2]', $body)->item(0));

            RawProduct::create(
                compact('url', 'thumb', 'name', 'technology_category', 'highlights',
                    'description', 'transfer_description', 'results')
            );
        }
    }

    private function getContent($element)
    {
        return trim(
            strip_tags(
                preg_replace(
                    '(<strong>.*?</strong>)is',
                    '',
                    convertHtmlToText($element)
                )
            )
        );
    }
}
