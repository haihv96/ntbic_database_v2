<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use App\Models\RawPatent;
use Illuminate\Console\Command;
use App\Services\CrawlRequest\CrawlRequestServiceInterface;

class CrawlPatents extends Command
{
    protected $signature = 'crawl:patents';
    protected $description = 'crawl patents from khoahoctot.vn';
    protected $crawlRequestService;

    public function __construct(CrawlRequestServiceInterface $crawlRequestService)
    {
        parent::__construct();
        $this->crawlRequestService = $crawlRequestService;
    }

    public function handle()
    {
        $start = $this->crawlRequestService->getXpath('http://khoahoctot.vn/index.php?lg=vi&com=invents&fun=search&q=');
        $pages = $start->query('(//div[@class="pages"]/a)[last()]')->item(0)->nodeValue * 30;
        for ($index = 0; $index <= $pages; $index += 30) {
            $url = "http://khoahoctot.vn/?com=invents&fun=search&catid=0&type=&q=&page=$index";
            $this->parsePatents($url);
        }
    }

    protected function parsePatents($url)
    {
        $patentsXpath = $this->crawlRequestService->getXpath($url);
        $patentUrls = $patentsXpath->query('//*[@id="wrapper"]/div[4]/div[2]/table/tbody/tr/td[4]/a/@href');
        foreach ($patentUrls as $url) {
            $url = $url->nodeValue;
            $patentXpath = $this->crawlRequestService->getXpath($url);
            $name = trim($patentXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[1]/tbody/tr/td/div[2]')->item(0)->nodeValue);
            $body = $patentXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[2]/tbody')->item(0);
            $patent_code = trim($patentXpath->query('./tr[1]/td[2]', $body)->item(0)->nodeValue);
            $base_technology_category = trim($patentXpath->query('./tr[2]/td[2]', $body)->item(0)->nodeValue);
            $public_date = trim($patentXpath->query('./tr[3]/td[2]', $body)->item(0)->nodeValue);
            $provide_date = trim($patentXpath->query('./tr[4]/td[2]', $body)->item(0)->nodeValue);
            $owner = trim($patentXpath->query('./tr[5]/td[2]', $body)->item(0)->nodeValue);
            $author = trim($patentXpath->query('./tr[6]/td[2]', $body)->item(0)->nodeValue);

            $body3 = $patentXpath->query('//*[@class="archives_list3"]')->item(0);
            $highlights = trim(
                convertHtmlToText(
                    $patentXpath->query('./tr[1]/td/div[2]', $body3)->item(0)
                )
            );
            $description = trim(
                convertHtmlToText(
                    $patentXpath->query('./tr[2]/td/div[2]', $body3)->item(0)
                )
            );
            $content_can_be_transferred = trim($patentXpath->query('./tr[3]/td/div[2]', $body3)->item(0)->nodeValue);
            $market_application = trim($patentXpath->query('./tr[4]/td/div[2]', $body3)->item(0)->nodeValue);
            $imagePath = $patentXpath->query('./tr[5]/td/div[2]/img/@src', $body3)->item(0);
            $image = null;
            if ($imagePath) {
                $imagePath = trim($imagePath->nodeValue);
                $image = 'http://khoahoctot.vn/' . $imagePath;
            }
            try {
                DB::beginTransaction();
                $rawPatent = RawPatent::create(
                    compact('url', 'name', 'patent_code', 'base_technology_category', 'public_date',
                        'provide_date', 'owner', 'author', 'highlights', 'description',
                        'content_can_be_transferred', 'market_application')
                );
                $image ? $rawPatent->addMediaFromUrl($image)->toMediaCollection('image') : null;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }

        }
    }
}
