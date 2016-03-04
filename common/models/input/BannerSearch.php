<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\Banner;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

/* Quang.nh */

class BannerSearch extends Model {

    public $id;
    public $name;
    public $active;
    public $link;
    public $position;
    public $type;
    public $sort;
    public $page;
    public $pageSize;
    public $w_thum = 0;
    public $h_thum = 0;

    public function rules() {
        return [
            [['name', 'type'], 'required'],
            [['active', 'position', 'id', 'page', 'pageSize', 'w_thum', 'h_thum'], 'integer'],
            [['name', 'link'], 'string', 'max' => 220],
            [['type'], 'string', 'max' => 50],
            [['sort'], 'string'],
        ];
    }

    public function search($page = false) {
        $query = Banner::find();
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->name != '' && $this->name != null) {
            $query->andWhere(['LIKE', 'name', strtolower($this->name)]);
        }
        if ($this->type != '' && $this->type != null) {
            $query->andWhere(['=', 'type', strtolower($this->type)]);
        }

        switch ($this->sort) {
            case 'position_asc':
                $query->orderBy("position ASC");
                break;
            default :
                $query->orderBy("position DESC");
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
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount;
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
     * gen image
     * @param type $ids
     * @return type
     */
    private function genImage($ids = []) {
        $thum = [];
        if ($this->w_thum > 0 && $this->h_thum > 0) {
            $thum = [$this->w_thum, $this->h_thum];
        }
        return ImageBusiness::getByTarget($ids, ImageType::BANNER, true, true);
    }

}
