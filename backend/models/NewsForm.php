<?php

namespace backend\models;

use common\models\business\NewsBusiness;
use common\models\db\News;
use common\models\output\Response;
use common\util\TextUtils;
use yii\base\Model;

class NewsForm extends Model {

    public $id;
    public $alias;
    public $name;
    public $categoryId;
    public $createTime;
    public $createEmail;
    public $updateTime;
    public $updateEmail;
    public $detail;
    public $description;
    public $active;
    public $home;
    public $footer;
    public $categoryName;

    public function rules() {
        return [
            [['alias', 'name', 'categoryId', 'detail','description'], 'required', 'message' => '{attribute} không được để trống'],
            [['categoryId', 'createTime', 'updateTime', 'active', 'id','home','footer'], 'integer'],
            [['detail','description'], 'string'],
            [['alias', 'name', 'createEmail', 'updateEmail', 'categoryName'], 'string', 'max' => 220]
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'Tên tin  tức',
            'detail' => 'Nội dung ',
            'description' => 'Mô tả',
        ];
    }

    public function save() {
        if (!$this->validate()) {
            return new Response(false, "Dữ liệu không chính xác vui lòng nhập lại", $this->errors);
        }

        $news = NewsBusiness::get($this->id);
        if ($news == null) {
            $news = new News();
            $news->createTime = time();
            $news->createEmail = $this->createEmail;
        }
        $news->name = $this->name;
        $news->alias = $this->genAlias();
        $news->updateTime = time();
        $news->updateEmail = $this->updateEmail;
        $news->categoryId = $this->categoryId;
        $news->detail = $this->detail;
        $news->description = $this->description;
        $news->active = $this->active == 1 ? 1 : 0;
        $news->home = $this->home == 1 ? 1 : 0;
        $news->footer = $this->footer == 1 ? 1 : 0;
        $news->categoryName = $this->categoryName;

        if (!$news->save(false)) {
            return new Response(false, "Dữ liệu truyền vào không chính xác vui lòng nhập lại", $news->errors);
        }

        return new Response(true, "Thao tác với bài tin -- " . $news->name . " --  thành công", $news);
    }

    private function genAlias() {
        $alias = $this->alias;
        if ($alias == null || $alias == "") {
            $alias = TextUtils::removeMarks($this->name);
        }
        return trim($alias);
    }

}
