<?php

namespace common\models\input;

use common\models\db\User;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;
// Lap Dam
class UserSearch extends Model {

    public $keyword;
    public $active;
    public $type;
    public $sort;
    public $page;
    public $pageSize;

    public function rules() {
        return [
            [['keyword', 'sort','type'], 'string'],
            [['pageSize', 'page', 'active'], 'integer'],
        ];
    }

    public function search($page = false) {
        $query = User::find();

        if ($this->keyword != null && $this->keyword != '') {
            $query->orWhere(['LIKE', 'username', strtolower($this->keyword)])->orWhere(['LIKE', 'fullname', strtolower($this->keyword)]);
        }
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }
        if ($this->type != null && $this->type != '') {
            $query->andWhere(['=', 'type', $this->type]);
        }

        switch ($this->sort) {
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            default :
                $query->orderBy("id DESC");
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
        $dataPage->pageCount = $dataPage->dataCount / $dataPage->pageSize;
        if ($dataPage->pageCount % $dataPage->pageSize != 0)
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount-1;
        return $dataPage;
    }

}
