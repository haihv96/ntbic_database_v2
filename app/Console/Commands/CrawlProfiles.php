<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use App\Models\RawProfile;
use Illuminate\Console\Command;
use App\Services\CrawlRequest\CrawlRequestServiceInterface;

class CrawlProfiles extends Command
{
    protected $signature = 'crawl:profiles';
    protected $description = 'crawl profile from khoahoctot.vn';
    protected $crawlRequestService;

    public function __construct(CrawlRequestServiceInterface $crawlRequestService)
    {
        parent::__construct();
        $this->crawlRequestService = $crawlRequestService;
    }

    public function handle()
    {
        $start = $this->crawlRequestService->getXpath('http://khoahoctot.vn/index.php?lg=vi&com=profiles&fun=search&q=');
        $pages = $start->query('(//div[@class="pages"]/a)[last()]')->item(0)->nodeValue * 15;
        for ($index = 0; $index <= $pages; $index += 15) {
            $url = "http://khoahoctot.vn/?com=profiles&fun=search&catid=0&fieldid=0&disnt=0&type=&field=0&q=&page=$index";
            $this->parseProfiles($url);
        }
    }

    protected function parseProfiles($url)
    {
        $profilesXpath = $this->crawlRequestService->getXpath($url);
        $profiles = $profilesXpath->query('//*[@id="wrapper"]/div[4]/div[2]/table/tbody/tr');
        foreach ($profiles as $profile) {
            $profileUrl = trim($profilesXpath->query('./td[5]/a/@href', $profile)->item(0)->nodeValue);
            $province = trim($profilesXpath->query('./td[8]', $profile)->item(0)->nodeValue);
            $profileInfo = $this->parseProfile($profileUrl);
            $profileInfo['province'] = $province;
            $image = $profileInfo['image'];
            unset($profileInfo['image']);
            try {
                DB::beginTransaction();
                $rawProfile = RawProfile::create($profileInfo);
                $image ? $rawProfile->addMediaFromUrl($image)->toMediaCollection('avatar') : null;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw new \Exception($e->getMessage());
            }
        }
    }

    protected function parseProfile($url)
    {
        $profileXpath = $this->crawlRequestService->getXpath($url);
        $header = $profileXpath->query('//table[@class="archives_list"][1]/tr')->item(0);
        $imagePath = $profileXpath->query('./td[1]/img/@src', $header)->item(0)->nodeValue;
        if ($imagePath != '/images/anon_user.png') {
            $image = 'http://khoahoctot.vn' . $imagePath;
        } else {
            $image = null;
        }
        $studies_or_papers_raw = trim(convertHtmlToText($profileXpath->query('./td[2]', $header)->item(0)));
        $studies_or_papers_string = trim(explode('<br>', $studies_or_papers_raw)[1]);
        $studies_or_papers = (int)last(explode(' ', $studies_or_papers_string));
        $body = $profileXpath->query('//table[@class="archives_list"][2]')->item(0);
        $name = trim($profileXpath->query('./tr[1]/td[3]/strong', $body)->item(0)->nodeValue);
        $academic_title = trim($profileXpath->query('./tr[2]/td[3]', $body)->item(0)->nodeValue);
        $birthday = trim($profileXpath->query('./tr[3]/td[3]', $body)->item(0)->nodeValue);
        $specialization = convertHtmlToText($profileXpath->query('./tr[4]/td[3]', $body)->item(0));
        $specialization = explode("<br>", $specialization);
        $specialization = join(
            '<br/>',
            array_filter(
                array_map(function ($item) {
                    return trim($item);
                }, $specialization)
            )
        );
        $agency = trim($profileXpath->query('./tr[5]/td[3]', $body)->item(0)->nodeValue);
        $agency_address = trim($profileXpath->query('./tr[6]/td[3]', $body)->item(0)->nodeValue);
        $research_for = convertHtmlToText($profileXpath->query('./tr[7]/td[3]', $body)->item(0));
        $col = 9;
        $research_joined = [];
        $colNum = trim($profileXpath->query("./tr[$col]/td[1]", $body)->item(0)->nodeValue);
        while ($colNum != '[8]' && $colNum != null) {
            $research_joined[] = '- ' . convertHtmlToText($profileXpath->query("./tr[$col]/td[2]", $body)->item(0));
            $col++;
            $colNum = trim($profileXpath->query("./tr[$col]/td[1]", $body)->item(0)->nodeValue);
        }
        $col++;

        $research_results = [];
        $colNum = $profileXpath->query("./tr[$col]/td[1]", $body)->item(0);
        while ($colNum != null) {
            $research_results[] = '- ' . convertHtmlToText($profileXpath->query("./tr[$col]/td[2]", $body)->item(0));
            $col++;
            $colNum = $profileXpath->query("./tr[$col]/td[1]", $body)->item(0);
        }
        $research_joined = join('<br/>', $research_joined);
        $research_results = join('<br/>', $research_results);
//        $specialization = json_encode($specialization, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//        $research_joined = json_encode($research_joined, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
//        $research_results = json_encode($research_results, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return compact('url', 'studies_or_papers', 'name', 'academic_title',
            'birthday', 'specialization', 'agency', 'agency_address',
            'research_for', 'research_joined', 'research_results', 'image');
    }

}
