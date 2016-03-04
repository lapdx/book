<?php

namespace common\models\input;

use common\models\db\Administrator;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;
// Lap Dam
class AdministratorSearch extends Model {

    public $email;
    public $active;
    public $startTime;
    public $endTime;
    public $sort;
    public $page;
    public $pageSize;

    public function rules() {
        return [
            [['email', 'sort'], 'string'],
            [['startTime', 'endTime'], 'number'],
            [['pageSize', 'page', 'active'], 'integer'],
        ];
    }

    public function search($page = false) {
        $query = Administrator::find();

        if ($this->email != null && $this->email != '') {
            $query->andWhere(['LIKE', 'id', strtolower($this->email)]);
        }
        if ($this->active > 0) {
            $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
        }

        if ($this->startTime > 0 && $this->endTime > 0) {
            $query->andWhere(['between', 'joinTime', $this->startTime / 1000, $this->endTime / 1000]);
        } else if ($this->startTime > 0) {
            $query->andWhere('joinTime >= :time', [':time' => $this->startTime / 1000]);
        } else if ($this->endTime > 0) {
            $query->andWhere('joinTime <= :time', [':time' => $this->endTime / 1000]);
        }
        switch ($this->sort) {
            case 'joinTime_asc':
                $query->orderBy("joinTime ASC");
                break;
            case 'lastTime_asc':
                $query->orderBy("lastTime ASC");
                break;
            case 'lastTime_desc':
                $query->orderBy("lastTime DESC");
                break;
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            default :
                $query->orderBy("joinTime DESC");
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
