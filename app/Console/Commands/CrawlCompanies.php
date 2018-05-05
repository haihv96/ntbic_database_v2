<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\DB;
use App\Models\RawCompany;
use App\Models\Company;
use Illuminate\Console\Command;
use App\Services\CrawlRequest\CrawlRequestServiceInterface;

class CrawlCompanies extends Command
{
    protected $signature = 'crawl:companies';
    protected $description = 'crawl companies from khoahoctot.vn';
    protected $crawlRequestService;
    protected $break = false;

    public function __construct(CrawlRequestServiceInterface $crawlRequestService)
    {
        parent::__construct();
        $this->crawlRequestService = $crawlRequestService;
    }

    public function handle()
    {
        $start = $this->crawlRequestService->getXpath('http://khoahoctot.vn/index.php?lg=vi&com=business&fun=search&q=');
        $pages = $start->query('(//div[@class="pages"]/a)[last()]')->item(0)->nodeValue * 15;
        for ($index = 0; $index <= $pages; $index += 15) {
            if ($this->break) break;
            $url = "http://khoahoctot.vn/?com=business&fun=search&catid=0&fieldid=0&disnt=0&type=&rate=&transfer=&field=0&q=&page=$index";
            $this->parseCompanies($url);
        }
    }

    protected function parseCompanies($url)
    {
        $companiesXpath = $this->crawlRequestService->getXpath($url);
        $companyUrls = $companiesXpath->query('//*[@id="wrapper"]/div[4]/div[2]/table/tbody/tr/td[5]/a/@href');
        foreach ($companyUrls as $url) {
            $url = $url->nodeValue;
            if (!$this->checkUrlAvail($url)) {
                $this->break = true;
                break;
            }
            $companyXpath = $this->crawlRequestService->getXpath($url);
            $body1 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[2]')->item(0);
            $imagePath = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[1]/tbody/tr/td[1]/img/@src')->item(0)->nodeValue;
            if ($imagePath != '/images/no_logo.png') {
                $image = 'http://khoahoctot.vn/' . $imagePath;
            } else {
                $image = null;
            }
            $name = trim($companyXpath->query('./tbody[1]/tr/td[2]', $body1)->item(0)->nodeValue);
            $last_update = trim($companyXpath->query('./tbody[2]/tr/td[2]', $body1)->item(0)->nodeValue);
            $base_technology_category = trim($companyXpath->query('./tbody[3]/tr/td[2]', $body1)->item(0)->nodeValue);
            $province = trim($companyXpath->query('./tbody[4]/tr/td[2]', $body1)->item(0)->nodeValue);
            $headquarters = trim($companyXpath->query('./tbody[5]/tr/td[2]', $body1)->item(0)->nodeValue);
            $email = trim($companyXpath->query('./tbody[6]/tr/td[2]', $body1)->item(0)->nodeValue);
            $phone = trim($companyXpath->query('./tbody[7]/tr/td[2]', $body1)->item(0)->nodeValue);
            $fax = trim($companyXpath->query('./tbody[8]/tr/td[2]', $body1)->item(0)->nodeValue);
            $website = trim($companyXpath->query('./tbody[9]/tr/td[2]', $body1)->item(0)->nodeValue);

            $body2 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[3]')->item(0);
            $company_code = trim(
                head(
                    explode('(Số Giấy chứng nhận', $companyXpath->query('./tbody[1]/tr/td[2]', $body2)->item(0)->nodeValue)
                )
            );
            $tax_code = trim($companyXpath->query('./tbody[2]/tr/td[2]', $body2)->item(0)->nodeValue);
            $type = trim($companyXpath->query('./tbody[3]/tr/td[2]', $body2)->item(0)->nodeValue);
            $founded = trim($companyXpath->query('./tbody[4]/tr/td[2]', $body2)->item(0)->nodeValue);
            $founder = trim($companyXpath->query('./tbody[5]/tr/td[2]', $body2)->item(0)->nodeValue);
            $founder_phone = trim($companyXpath->query('./tbody[6]/tr/td[2]', $body2)->item(0)->nodeValue);
            $founder_email = trim($companyXpath->query('./tbody[7]/tr/td[2]', $body2)->item(0)->nodeValue);
            $founder_address = trim($companyXpath->query('./tbody[8]/tr/td[2]', $body2)->item(0)->nodeValue);

            $body3 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[4]')->item(0);
            $industry = trim($companyXpath->query('./tbody[1]/tr/td[2]', $body3)->item(0)->nodeValue);
            $tax_information = trim($companyXpath->query('./tbody[2]/tr/td[2]', $body3)->item(0)->nodeValue);

            $body4 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[5]')->item(0);
            $company_branch = trim($companyXpath->query('./tbody[1]/tr/td', $body4)->item(0)->nodeValue);

            $body5 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[6]')->item(0);
            $representative_office = trim($companyXpath->query('./tbody[1]/tr/td', $body5)->item(0)->nodeValue);

            $body6 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[7]')->item(0);
            $TRC_number = trim($companyXpath->query('./tbody[2]/tr/td[2]', $body6)->item(0)->nodeValue);
            $TRC_date = trim($companyXpath->query('./tbody[3]/tr/td[2]', $body6)->item(0)->nodeValue);
            $TRC_place = trim($companyXpath->query('./tbody[4]/tr/td[2]', $body6)->item(0)->nodeValue);
            $technology_rank = trim($companyXpath->query('./tbody[5]/tr/td[2]', $body6)->item(0)->nodeValue);
            $research_for = trim($companyXpath->query('./tbody[6]/tr/td[2]', $body6)->item(0)->nodeValue);
            $number_of_employees_research = trim($companyXpath->query('./tbody[7]/tr/td[2]', $body6)->item(0)->nodeValue);
            $technology_highlight = trim($companyXpath->query('./tbody[8]/tr/td[2]', $body6)->item(0)->nodeValue);
            $technology_using = trim($companyXpath->query('./tbody[9]/tr/td[2]', $body6)->item(0)->nodeValue);
            $technology_transfer = trim(
                $companyXpath->query('./tbody[10]/tr/td[2]/input[@checked="checked"]/@value', $body6)
                    ->item(0)->nodeValue
            );
            $technology_transfer = $this->transferTech($technology_transfer);
            $body7 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[8]')->item(0);
            $results = trim($companyXpath->query('./tbody[1]/tr/td', $body7)->item(0)->nodeValue);

            $body8 = $companyXpath->query('//*[@id="wrapper"]/div[5]/div[2]/div[2]/table[9]')->item(0);
            $products = trim($companyXpath->query('./tbody[1]/tr/td', $body8)->item(0)->nodeValue);

            try {
                DB::beginTransaction();
                $rawCompany = RawCompany::create(
                    compact('url', 'image', 'name', 'last_update', 'base_technology_category', 'province',
                        'headquarters', 'email', 'phone', 'fax', 'website', 'company_code', 'tax_code', 'type', 'founded',
                        'founder', 'founder_phone', 'founder_email', 'founder_address', 'industry',
                        'tax_information', 'company_branch', 'representative_office', 'TRC_number',
                        'TRC_date', 'TRC_place', 'technology_rank', 'research_for',
                        'number_of_employees_research', 'technology_highlight', 'technology_using',
                        'technology_transfer', 'results', 'products')
                );
                $image ? $rawCompany->addMediaFromUrl($image)->toMediaCollection('logo') : null;
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
            }

        }
    }

    private function transferTech($value)
    {
        switch ($value) {
            case 0:
                return 'Không có CN muốn chuyển giao';
            case 1:
                return 'Có CN muốn chuyển giao ';
            case 2:
                return 'Muốn mua công nghệ để phát triển năng lực sản xuất và kinh doanh';
        }
    }

    private function checkUrlAvail($url)
    {
        return RawCompany::where('url', $url)->get()->isEmpty()
            && Company::where('url', $url)->get()->isEmpty();
    }
}

