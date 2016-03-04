<?php

namespace common\models\input;

use common\models\db\Contact;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

// Lap Dam
class ContactSearch extends Model {

    public $keyword;
    public $sort;
    public $page;
    public $pageSize;
    public $createTimeFrom;
    public $createTimeTo;
    public $updateTimeFrom;
    public $updateTimeTo;

    public function rules() {
        return [
            [['keyword', 'sort'], 'string'],
            [['pageSize', 'page','createTimeFrom','createTimeTo','updateTimeFrom','updateTimeTo'], 'integer'],
        ];
    }

    public function search($page = false) {
        $query = Contact::find();
        if (!empty($this->keyword)) {
            $query->andWhere(['LIKE', 'name', strtolower($this->keyword)])->orWhere(['LIKE', 'email', strtolower($this->keyword)])->orWhere(['LIKE', 'content', strtolower($this->keyword)]);
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
            case 'updateTime_asc':
                $query->orderBy("updateTime ASC");
                break;
            case 'updateTime_desc':
                $query->orderBy("updateTime DESC");
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
        $dataPage->pageCount = $dataPage->dataCount / $dataPage->pageSize;
        if ($dataPage->pageCount % $dataPage->pageSize != 0)
            $dataPage->pageCount = ceil($dataPage->pageCount) + 1;
        $dataPage->pageCount = $dataPage->pageCount < 1 ? 1 : $dataPage->pageCount - 1;
        return $dataPage;
    }

}
