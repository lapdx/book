<?php

namespace console\controllers;

use common\models\business\CategoryBusiness;
use common\models\business\CrawlBusiness;
use common\models\business\ItemBusiness;
use common\models\business\LogItemBusiness;
use common\models\business\SiteBusiness;
use Exception;
use IntlCalendar;

class CrawlController extends ConsoleController {

    /**
     * Crawl sản phẩm
     */
    public function actionCrawl() {
        $cal = IntlCalendar::fromDateTime(date('h:i:s m/d/Y', time()));
        while (true) {
            $category = CategoryBusiness::getCrawl($cal);
            if ($category == null) {
                break;
            }
            $site = SiteBusiness::get($category->siteId);
            if ($site == null) {
                break;
            }
            print_r("--> crawl link : " . $category->link . "\n");
			//continue;
            $iPaths = CrawlBusiness::getItemPath($site, $category->link);
            print_r("\t-->link : " . count($iPaths) . "\n");
            $iPage = [];
            foreach ($iPaths as $iPath) {
                print_r("\t--> crawl item : " . $iPath . "\n");
                $item = CrawlBusiness::getItem($site, $iPath);
                $item[] = ["keyword" => 'sourceLink', 'value' => $this->encode($iPath)];
                $item[] = ["keyword" => 'sellerId', 'value' => $this->encode($site->sellerId)];
                $item[] = ["keyword" => 'categoryId', 'value' => $this->encode($category->categoryId)];
                $item[] = ["keyword" => 'sCategoryId', 'value' => $this->encode($category->sCategoryId)];
                ItemBusiness::save($iPath, $site, $category, $item);
            }
            $category->updateTime = time();
            $category->crawlWait = 0;
            $category->nextTime = time();
            $category->save();
        }
    }

}
