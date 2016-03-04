<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\Partners;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class PartnersSearch extends Model {

    public $name;
    public $active;
    public $home;
    public $sort;
    public $page;
    public $pageSize;
    public $w_thum = 0;
    public $h_thum = 0;

    public function rules() {
        return [
            [['name', 'sort'], 'string'],
            [['pageSize', 'home', 'page', 'active'], 'integer'],
        ];
    }

    /**
     * search
     * @param type $page
     * @return DataPage
     */
    public function search($page = false) {
        $query = Partners::find();
        if ($this->name != null && $this->name != '') {
            $query->andWhere(['LIKE', 'name', strtolower($this->name)]);
        }
       
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->home > 0) {
            $query->andWhere(['=', 'home', $this->home == 1 ? 1 : 0]);
        }
        switch ($this->sort) {
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            default :
                $query->orderBy("active DESC");
        }
        $dataPage = new DataPage();
        if (!$page) {
            return $query;
        }
        $dataPage->dataCount = $query->count();
        $dataPage->dataCount = $dataPage->dataCount == null ? 0 : $dataPage->dataCount;
        $dataPage->pageSize = $this->pageSize <= 0 ? 100 : $this->pageSize;
        $dataPage->page = $this->page <= 0 ? 1 : $this->page;
        $paging = new Pagination(['totalCount' => $dataPage->dataCount]);
        $paging->setPageSize($dataPage->pageSize);
        $paging->setPage($dataPage->page - 1);
        $query->limit($paging->getLimit());
        $query->offset($paging->getOffset());
        $dataPage->data = $query->all();
        $dataPage->pageCount = intval($dataPage->dataCount / $dataPage->pageSize);
        if ($dataPage->pageCount % $dataPage->pageSize != 0)
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount - 1;
        $ids = [];
        foreach ($dataPage->data as $item) {
            $ids[] = $item->id;
        }
        $images = $this->genImage($ids);
        foreach ($dataPage->data as $item) {
            $item->images = isset($images[$item->id]) ? $images[$item->id] : [];
        }
        return $dataPage;
    }

    /**
     * Image file
     * @param type $ids
     * @return type
     */
    private function genImage($ids = []) {
        $thum = [];
        if ($this->w_thum > 0 && $this->h_thum > 0) {
            $thum = [$this->w_thum, $this->h_thum];
        }
        return ImageBusiness::getByTarget($ids, ImageType::PARTNERS, true, true);
    }

}
