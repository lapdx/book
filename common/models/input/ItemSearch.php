<?php

namespace common\models\input;

use common\models\business\ImageBusiness;
use common\models\db\Item;
use common\models\enu\ImageType;
use common\models\output\DataPage;
use yii\base\Model;
use yii\data\Pagination;

class ItemSearch extends Model {

    public $keyword;
    public $active;
    public $categoryId;
    public $categoryIds;
    public $partnersIds;
    public $powers;
    public $prices;
    public $origins;
    public $types;
    public $noises;
    public $sort;
    public $page;
    public $pageSize;
    public $w_thum = 0;
    public $h_thum = 0;
    public $ids;

    public function rules() {
        return [
            [['keyword', 'sort', 'ids'], 'string'],
            [['pageSize', 'page', 'active','partnersIds','categoryIds','categoryId','powers','noises','types','prices','origins'], 'integer'],
        ];
    }

    /**
     * search
     * @param type $page
     * @return DataPage
     */
    public function search($page = false) {
        $query = Item::find();
        if (!is_array($this->ids)) {
            $this->ids = [];
        }
        if (!is_array($this->categoryIds)) {
            $this->categoryIds = [];
        }
        if (!is_array($this->partnersIds)) {
            $this->partnersIds = [];
        }
        if (!is_array($this->powers)) {
            $this->powers = [];
        }
        if (!is_array($this->noises)) {
            $this->noises = [];
        }
        if (!is_array($this->types)) {
            $this->types = [];
        }
        if (!is_array($this->prices)) {
            $this->prices = [];
        }
        if (!empty($this->ids) && sizeof($this->ids) > 0) {
            $query = Item::find()->where(['id' => $this->ids]);
        } else {
            if ($this->keyword != null && $this->keyword != '') {
                $query->andWhere(['LIKE', 'name', strtolower($this->keyword)])->orWhere(['LIKE', 'description', strtolower($this->keyword)])->orWhere(['LIKE', 'content', strtolower($this->keyword)]);
            }
            if ($this->active > 0) {
                $query->andWhere(['=', 'active', $this->active == 1 ? 1 : 0]);
            }
            if ($this->categoryId > 0) {
                $query->andWhere(['=', 'categoryId', $this->categoryId]);
            }
            if (!empty($this->categoryIds)) {
                $query->andWhere(['categoryId'=>$this->categoryIds]);
            }
            if (!empty($this->partnersIds)) {
                $query->andWhere(['partnersId'=>$this->partnersIds]);
            }
            if (!empty($this->types)) {
                $query->andWhere(['type'=>$this->types]);
                if(in_array(5, $this->types)){
                $query->andWhere(['>','type',4]);    
                }
            }
            if (!empty($this->powers)) {
                if(in_array(1, $this->powers)){
                $query->andWhere(['between','power',1000,3000]);    
                }
                if(in_array(2, $this->powers)){
                $query->andWhere(['between','power',3000,5000]);    
                }
                if(in_array(3, $this->powers)){
                $query->andWhere(['between','power',4500,6000]);    
                }
                if(in_array(4, $this->powers)){
                $query->andWhere(['between','power',6000,7500]);    
                }
                if(in_array(5, $this->powers)){
                $query->andWhere(['>','power',7500]);    
                }
            }
            if (!empty($this->noises)) {
                if(in_array(1, $this->noises)){
                $query->andWhere(['between','noise',40,45]);    
                }
                if(in_array(2, $this->noises)){
                $query->andWhere(['between','noise',45,50]);    
                }
                if(in_array(3, $this->noises)){
                $query->andWhere(['between','noise',50,55]);    
                }
                if(in_array(4, $this->noises)){
                $query->andWhere(['between','noise',55,60]);    
                }
                if(in_array(5, $this->noises)){
                $query->andWhere(['>','noise',60]);    
                }
            }
            if (!empty($this->prices)) {
                if(in_array(1, $this->prices)){
                $query->andWhere(['between','sellPrice',1000000,3000000]);    
                }
                if(in_array(2, $this->prices)){
                $query->andWhere(['between','sellPrice',3000000,5000000]);    
                }
                if(in_array(3, $this->prices)){
                $query->andWhere(['between','sellPrice',5000000,10000000]);    
                }
                if(in_array(4, $this->prices)){
                $query->andWhere(['between','sellPrice',10000000,15000000]);    
                }
                if(in_array(5, $this->prices)){
                $query->andWhere(['between','sellPrice',15000000,20000000]);    
                }
                if(in_array(6, $this->prices)){
                $query->andWhere(['>','sellPrice',20000000]);    
                }
            }
            if (!empty($this->origins)) {
                foreach ($this->origins as $value) {
                    $query->andWhere(['LIKE','origin',$value]);
                }
            }
            
        }
        switch ($this->sort) {
            case 'active_asc':
                $query->orderBy("active ASC");
                break;
            case 'name_asc':
                $query->orderBy("name ASC");
                break;
            case 'active_desc':
                $query->orderBy("active DESC");
                break;
            case 'createTime_desc':
                $query->orderBy("createTime DESC");
                break;
            case 'price_desc':
                $query->orderBy("sellPrice DESC");
                break;
            case 'name_desc':
                $query->orderBy("name DESC");
                break;
            case 'price_desc':
                $query->orderBy("sellPrice DESC");
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
     * Image file
     * @param type $ids
     * @return type
     */
    private function genImage($ids = []) {
        $thum = [];
        if ($this->w_thum > 0 && $this->h_thum > 0) {
            $thum = [$this->w_thum, $this->h_thum];
        }
        return ImageBusiness::getByTarget($ids, ImageType::ITEM, true, true);
    }

}
