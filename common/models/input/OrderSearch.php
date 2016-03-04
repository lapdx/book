<?php

namespace common\models\input;

use common\models\business\OrderItemBusiness;
use common\models\db\OrderInfo;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class OrderSearch extends Model {

    public $id;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $paymentMethod;
    public $createTimeFrom;
    public $createTimeTo;
    public $updateTimeFrom;
    public $updateTimeTo;
    public $remove;
    public $note;
    public $sort;
    public $page;
    public $pageSize;

    function rules() {
        return [
            [['createTimeFrom', 'createTimeTo', 'updateTimeFrom', 'updateTimeTo', 'remove', 'pageSize', 'page', 'id'], 'integer'],
            [['note', 'name', 'phone', 'address', 'sort', 'paymentMethod','email'], 'string'],
        ];
    }

    public function search($page = false) {
        $query = OrderInfo::find()->andWhere(['<>','remove',1]);
        if (!empty($this->id)) {
            $query->andWhere(['=', 'id', $this->id]);
        }
        if (!empty($this->name)) {
            $query->andWhere(['LIKE', 'name', $this->name]);
        }
        if (!empty($this->email)) {
            $query->andWhere(['LIKE', 'email', $this->email]);
        }
        if (!empty($this->address)) {
            $query->andWhere(['LIKE', 'address', $this->address]);
        }
        if (!empty($this->note)) {
            $query->andWhere(['LIKE', 'note', $this->note]);
        }
        if (!empty($this->phone)) {
            $query->andWhere(['LIKE', 'phone', $this->phone]);
        }
        if (!empty($this->paymentMethod)) {
            $query->andWhere(['=', 'paymentMethod', $this->paymentMethod]);
        }

        if ($this->createTimeFrom > 0 && $this->createTimeTo > 0) {
            $query->andWhere(['between', 'createTime', $this->createTimeFrom / 1000, $this->createTimeTo / 1000]);
        } else if ($this->createTimeFrom > 0) {
            $query->andWhere('createTime >= :time', [':time' => $this->createTimeFrom / 1000]);
        } else if ($this->createTimeTo > 0) {
            $query->andWhere('createTime <= :time', [':time' => $this->createTimeTo / 1000]);
        }

        if ($this->updateTimeFrom > 0 && $this->updateTimeTo > 0) {
            $query->andWhere(['between', 'updateTime', $this->updateTimeFrom / 1000, $this->updateTimeTo / 1000]);
        } else if ($this->updateTimeFrom > 0) {
            $query->andWhere('createTime >= :time', [':time' => $this->updateTimeFrom / 1000]);
        } else if ($this->updateTimeTo > 0) {
            $query->andWhere('createTime <= :time', [':time' => $this->updateTimeTo / 1000]);
        }

        switch ($this->sort) {
            case 'createTime_asc':
                $query->orderBy("createTime ASC");
                break;
            case 'createTime_desc':
                $query->orderBy("createTime DESC");
                break;
            case 'updateTime_asc':
                $query->orderBy("updateTime ASC");
                break;
            case 'updateTime_desc':
                $query->orderBy("updateTime DESC");
                break;
            case 'name_asc':
                $query->orderBy("name ASC");
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
        foreach ($dataPage->data as $order) {
            $ids[] = $order->id;
        }
        $items = OrderItemBusiness::mGet(['orderId' => $ids]);
        foreach ($dataPage->data as $order) {
            $orderItem = [];
            foreach ($items as $item) {
                if ($item->orderId == $order->id) {
                    $orderItem[] = $item;
                }
            }
            $order->items = $orderItem;
        }
        return $dataPage;
    }

}
