<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\News;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class NewsSearch extends Model {

    public $keyword;
    public $categoryId;
    public $categoryIds;
    public $active;
    public $home;
    public $sort;
    public $page;
    public $pageSize;
    public $createTimeFrom;
    public $updateTimeFrom;
    public $createTimeTo;
    public $updateTimeTo;
    public $w_thum = 0;
    public $h_thum = 0;

    public function rules() {
        return [
            [['keyword', 'sort'], 'string'],
            [['pageSize', 'categoryId', 'categoryIds', 'page', 'active', 'createTimeFrom', 'updateTimeFrom', 'createTimeTo', 'updateTimeTo'], 'integer'],
        ];
    }

    /**
     * search
     * @param type $page
     * @return DataPage
     */
    public function search($page = false) {
        $query = News::find();
        if (is_array($this->categoryIds)) {
            $query->andWhere(['categoryId'=>$this->categoryIds]);
        }
        if ($this->keyword != null && $this->keyword != '') {
            $query->andWhere(['LIKE', 'name', strtolower($this->keyword)])->orWhere(['LIKE', 'detail', strtolower($this->keyword)])->orWhere(['LIKE', 'alias', strtolower($this->keyword)]);
        }
        if ($this->categoryId != null && $this->categoryId > 0) {
            $query->andWhere(['=', 'categoryId', strtolower($this->categoryId)]);
        }
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->home > 0) {
            $query->andWhere(['=', 'home', $this->home == 1 ? 1 : 0]);
        }
        if ($this->createTimeFrom > 0 && $this->createTimeTo > 0) {
            $query->andWhere(['between', 'createTime', $this->createTimeFrom / 1000, $this->createTimeTo / 1000]);
        } else if ($this->createTimeFrom > 0) {
            $query->andWhere('createTime >= :time', [':time' => $this->createTimeFrom / 1000]);
        } elseif ($this->createTimeTo > 0) {
            $query->andWhere('createTime <= :time', [':time' => $this->createTimeTo / 1000]);
        }

        if ($this->updateTimeFrom > 0 && $this->updateTimeTo > 0) {
            $query->andWhere(['between', 'updateTime', $this->updateTimeFrom / 1000, $this->updateTimeTo / 1000]);
        } else if ($this->updateTimeFrom > 0) {
            $query->andWhere('updateTime >= :time', [':time' => $this->updateTimeFrom / 1000]);
        } else if ($this->updateTimeTo > 0) {
            $query->andWhere('updateTime <= :time', [':time' => $this->updateTimeTo / 1000]);
        }
        switch ($this->sort) {
            case 'createTime_asc':
                $query->orderBy("createTime ASC");
                break;
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            default :
                $query->orderBy("createTime DESC");
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
        return ImageBusiness::getByTarget($ids, ImageType::NEWS, true, true);
    }

}
