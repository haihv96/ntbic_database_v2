<?php

namespace App\Console\Commands;

use App\Models\RawProject;
use Illuminate\Console\Command;
use App\Services\CrawlRequest\CrawlRequestServiceInterface;

class CrawlProjects extends Command
{
    protected $signature = 'crawl:projects';
    protected $description = 'crawl projects from khoahoctot.vn';
    protected $crawlRequestService;

    public function __construct(CrawlRequestServiceInterface $crawlRequestService)
    {
        parent::__construct();
        $this->crawlRequestService = $crawlRequestService;
    }

    public function handle()
    {
        $start = $this->crawlRequestService->getXpath('http://khoahoctot.vn/index.php?lg=vi&com=projects&fun=search&q=');
        $pages = $start->query('(//div[@class="pages"]/a)[last()]')->item(0)->nodeValue * 30;
        for ($index = 0; $index <= $pages; $index += 30) {
            $url = "http://khoahoctot.vn/?com=projects&fun=search&catid=0&fieldid=&disnt=0&type=&field=0&q=&page=$index";
            $this->parseProjects($url);
        }
    }

    protected function parseProjects($url)
    {
        $projectsXpath = $this->crawlRequestService->getXpath($url);
        $projectUrls = $projectsXpath->query('//*[@id="wrapper"]/div[4]/div[2]/table/tbody/tr/td[4]/a/@href');
        foreach ($projectUrls as $url) {
            $url = $url->nodeValue;
            $projectXpath = $this->crawlRequestService->getXpath($url);
            $name = trim($projectXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/div[2]')->item(0)->nodeValue);
            $body = $projectXpath->query('//*[@class="archives_list"]/tbody')->item(0);
            $project_code = trim($projectXpath->query('./tr[1]/td[2]', $body)->item(0)->nodeValue);
            $technology_category = trim($projectXpath->query('./tr[2]/td[2]', $body)->item(0)->nodeValue);
            $start_date_invest = trim($projectXpath->query('./tr[3]/td[2]', $body)->item(0)->nodeValue);
            $close_date = trim($projectXpath->query('./tr[4]/td[2]', $body)->item(0)->nodeValue);
            $operator = trim($projectXpath->query('./tr[5]/td[2]', $body)->item(0)->nodeValue);
            $author = trim($projectXpath->query('./tr[6]/td[2]', $body)->item(0)->nodeValue);

            $body3 = $projectXpath->query('//*[@class="archives_list3"]')->item(0);
            $highlights = trim(
                convertHtmlToText(
                    $projectXpath->query('./tr[1]/td/div[2]', $body3)->item(0)
                )
            );
            $description = trim(
                convertHtmlToText(
                    $projectXpath->query('./tr[2]/td/div[2]', $body3)->item(0)
                )
            );
            $transfer_description = trim($projectXpath->query('./tr[3]/td/div[2]', $body3)->item(0)->nodeValue);
            $results = trim($projectXpath->query('./tr[4]/td/div[2]', $body3)->item(0)->nodeValue);

            RawProject::create(
                compact('url', 'name', 'project_code', 'technology_category',
                    'start_date_invest', 'close_date', 'operator', 'author', 'highlights',
                    'description', 'transfer_description', 'results')
            );
        }
    }
}
