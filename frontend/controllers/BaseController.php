<?php

namespace frontend\controllers;

use common\models\business\BannerBusiness;
use common\models\business\CategoryBusiness;
use common\models\business\HomeBusiness;
use common\models\business\NewsBusiness;
use common\models\business\NewsCategoryBusiness;
use common\models\business\OrderBusiness;
use common\models\business\PartnersBusiness;
use common\models\enu\BannerType;
use common\models\input\ItemSearch;
use common\util\TextUtils;
use yii\web\Controller;

class BaseController extends Controller {

    public $staticClient;
    public $baseUrl;
    public $title;
    public $description;
    public $keywrod;
    public $og;
    public $canonical;
    public $var = [];

    public function init() {
        parent::init();
        $this->baseUrl = 'http://' . $_SERVER['HTTP_HOST'] . str_replace("index.php", '', $_SERVER['SCRIPT_NAME']);
        $this->mDefault();
        $this->home();
        $this->var['browse'] = 0;
        $this->var['index'] = 0;
        $this->var['new'] = 0;
        $this->var['item'] = 0;
        $this->var['contact'] = 0;
        $this->var['checkout'] = 0;
        $this->var['flag'] = 0;
    }

    public function home() {
        $this->var['news'] = NewsBusiness::getAll(5, true, true);
        $this->var['footer'] = NewsBusiness::getAll(8, true, false, true);
        $this->var['categories'] = CategoryBusiness::getAll(true);
        $this->var['newscategories'] = NewsCategoryBusiness::getAll(1);
        $this->var['home'] = HomeBusiness::get(1);
        $this->var['partners'] = PartnersBusiness::getAll('', true, true);
        $this->var ['right'] = BannerBusiness::getByType(BannerType::RIGHT, true);
        $this->var ['left'] = BannerBusiness::getByType(BannerType::LEFT, true);
        $this->var ['center'] = BannerBusiness::getByType(BannerType::CENTER, true);
        $this->var ['menu'] = NewsCategoryBusiness::getAll(true,null,true);
        $cart = OrderBusiness::getCart();
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart->items as $item) {
                $total += $item->sellPrice * $item->quantity;
            }
        }
        $this->var['total'] = TextUtils::sellPrice($total);
        
        $search = new ItemSearch();
        $search->active = 1;
        $search->page = 1;
        $search->pageSize = 5;
        $search->sort = 'createTime_desc';
        $this->var ['hotitem'] = $search->search(true)->data;
        
    }

    /**
     * config default
     */
    private function mDefault() {
        $this->title = "Siêu thị Hoa lửa Chuyên cung cấp các loại thiết bị nhà bếp nhập khẩu";
        $this->keywrod = "bếp từ, bếp điện từ,  bếp ga âm, máy hút mùi";
        $this->description = "Hoa lửa chuyên cung cấp các loại thiết bị nhà bếp nhập khẩu chính hãng như bếp từ, bếp điện từ,  bếp ga âm, máy hút mùi..";
        /**
         * config default og
         */
        $this->og = [
            "title" => "Siêu thị Hoa lửa Chuyên cung cấp các loại thiết bị nhà bếp nhập khẩu",
            "site_name" => "Hoa lửa",
            "url" => $this->baseUrl,
            "image" => "",
            "description" => $this->description,
        ];
        $this->canonical = $this->baseUrl;
    }

    /**
     * Config meta
     * @param type $title
     * @param type $description
     * @param type $url
     * @param type $image
     * @param type $keywrod
     */
    protected function meta($title = null, $description = null, $url = null, $image = null, $keywrod = null) {
        if ($title != null) {
            $this->title = $title;
            $this->og['title'] = $title;
        }
        if ($description != null) {
            $this->description = $description;
            $this->og['description'] = $this->description;
        }
        if ($keywrod != null) {
            $this->keywrod = $keywrod;
        }
        if ($url != null) {
            $this->canonical = $url;
            $this->og['url'] = $this->canonical;
        }
        if ($image != null) {
            $this->og['image'] = $image;
        }
    }

}
