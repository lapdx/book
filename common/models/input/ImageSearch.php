<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\Image;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class ImageSearch extends Model {

    public $w_thum = 0;
    public $h_thum = 0;
    public $sort;
    public $page;
    public $pageSize;

    public function rules() {
        return [
            [['sort'], 'string'],
            [['pageSize', 'page', 'w_thum', 'h_thum'], 'integer'],
        ];
    }

    public function search($page) {
        $query = Image::find();
        switch ($this->sort) {
            case 'position_asc':
                $query->orderBy("position ASC");
                break;
            case 'type_asc':
                $query->orderBy("type ASC");
                break;
            case 'type_desc':
                $query->orderBy("type DESC");
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
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount - 1;
        return $dataPage;
    }

}
