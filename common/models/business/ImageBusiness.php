<?php

namespace common\models\business;

use common\models\db\Image;
use common\models\enu\ImageType;
use common\models\output\Response;
use common\util\ImageClient;
use common\util\TextUtils;
use Exception;
use Yii;

class ImageBusiness {

    const root = '/upload';
    const baseUrl = 'http://localhost/airocide/frontend/public/';
    const level = 0;

    private static function genName($name, $imageType) {
        $explode = explode(".", trim(str_replace(" ", "-", $name)));
        $imgT = explode("/", $imageType);
        return $explode[0] . "-" . time() . "." . $imgT[1];
    }

    /**
     * save image
     * @param type $name
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @return Response
     */
    public static function save($name, $type, $targetId, $position = 0) {
        $image = new Image();
        $image->targetId = $targetId;
        $image->position = $position;
        $image->type = $type;
        $image->imageId = $name;
        if (!$image->save()) {
            return new Response(false, "Thêm ảnh không thành công", $image->errors);
        }
        return new Response(true, "Thêm ảnh thành công", $image);
    }

    /**
     * thumb ảnh
     * @param Image $image
     * @param type $thumbnail
     */
    private static function thumbnail($iPath, Image $image, $thumbnail) {
        if (!empty($thumbnail) && is_array($thumbnail) && !empty($image)) {
            foreach ($thumbnail as $thum) {
                if (!empty($thum) && is_array($thum)) {
                    $path = preg_replace("/target_(.*)\//", "target_" . $image->targetId . "/" . $thum[0] . "x" . $thum[1] . "_", $iPath);
                    ImageClient::thumbnail($iPath, $thum[0], $thum[1])->save($path);
                }
            }
        }
    }

    /**
     * 
     * @param type $imageUrl
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @return type
     */
    public static function dowload($url, $type = ImageType::_DEFAULT, $targetId = '0', $position = 0, $thumbnail = []) {
        $imageType = get_headers($url, 1)["Content-Type"];
        $imgT = explode("/", $imageType);
        if ($imgT[0] != 'image') {
            return new Response(false, "Địa chỉ không phải là ảnh", $imgT);
        }
        try {
            if (!$resp = TextUtils::exists($url)) {
                // return new Response(false, "Địa chỉ ảnh không phải là ảnh", $resp);
            }
        } catch (Exception $exc) {
            return new Response(false, "Địa chỉ ảnh không tồn tại");
        }
        $image = explode("/", $url);
        $path = self::root . '/' . strtolower($type) . '/target_' . $targetId . '/' . self::genName(end($image), $imageType);
        $image = TextUtils::randomPathfile(Yii::getAlias("@frontend") . '/public' . self::root . '/' . $type . '/target_' . $targetId . '/', ImageBusiness::level, false) . self::genName(end($image), $imageType);
        ImageClient::frame($url, 0, '666', 0)->save($image);
        $resp = self::save($path, $type, $targetId, $position);
        if ($resp->success) {
            self::thumbnail($image, $resp->data, $thumbnail);
        }
        return $resp;
    }

    /**
     * 
     * @param type $file
     * @param type $type
     * @param type $targetId
     * @param type $position
     * @return type
     */
    public static function upload($image, $type = ImageType::_DEFAULT, $targetId = '0', $position = 0, $thumbnail = []) {
        if (!is_object($image)) {
            return new Response(false, "Dữ liệu nhập vào không phải thông tin ảnh");
        }
        $imgT = explode("/", $image->type);
        if ($imgT[0] != 'image') {
            return new Response(false, "Địa chỉ không phải là ảnh");
        }
        $path = self::root . '/' . strtolower($type) . '/target_' . $targetId . '/' . self::genName($image->name, $image->type);
        $imagePath = TextUtils::randomPathfile(Yii::getAlias("@frontend") . '/public' . self::root . '/' . $type . '/target_' . $targetId . '/', ImageBusiness::level, false) . self::genName($image->name, $image->type);
        move_uploaded_file($image->tempName, $imagePath);
        $resp = self::save($path, $type, $targetId, $position);
        if ($resp->success) {
            self::thumbnail($imagePath, $resp->data, $thumbnail);
        }
        return $resp;
    }

    /**
     * 
     * @param type $condition
     * @param type $type
     * @param type $getUrl
     * @param type $thumbnail
     * @return type
     */
    public static function getByTarget($condition, $type = ImageType::_DEFAULT, $getUrl = false, $baseUrl = false) {
        $config = Yii::$app->params['image'];
        $imgs = Image::find()->andWhere(["targetId" => $condition, 'type' => $type])->all();
        if ($imgs == null || empty($imgs)) {
            return $imgs;
        }

        $url = [];
        foreach ($imgs as $img) {
            if (!isset($url[$img->targetId]) || $url[$img->targetId] == null) {
                $url[$img->targetId] = [];
            }
            $url[$img->targetId][] = ($baseUrl ? $config['baseUrl'] : '') . $img->imageId;
        }
        if ($getUrl) {
            return $url;
        }
        return $imgs;
    }
    public static function getByType($type = ImageType::_DEFAULT, $getUrl = false, $baseUrl = false) {
        $config = Yii::$app->params['image'];
        $imgs = Image::find()->andWhere([ 'type' => $type])->all();
        if ($imgs == null || empty($imgs)) {
            return $imgs;
        }

        $url = [];
        foreach ($imgs as $img) {
            if (!isset($url[$img->targetId]) || $url[$img->targetId] == null) {
                $url[$img->targetId] = [];
            }
            $url[$img->targetId][] = ($baseUrl ? $config['baseUrl'] : '') . $img->imageId;
        }
        if ($getUrl) {
            return $url;
        }
        return $imgs;
    }

    public static function deleteByImageId($condition) {
        Image::deleteAll(["imageId" => $condition]);
        if (!is_array($condition)) {
            self::delete($condition);
            return true;
        }
        foreach ($condition as $imageId) {
            self::delete($imageId);
        }
        return true;
    }

    /**
     * 
     * @param type $condition
     * @return boolean
     */
    public static function deleteByTarget($condition) {
        $images = Image::find()->andWhere(["targetId" => $condition])->all();
        foreach ($images as $image) {
            self::delete($image->imageId);
        }
        Image::deleteAll(["targetId" => $condition]);
    }

    public static function delete($imagePath) {
        $filePath = Yii::getAlias("@frontend") . '/public' . $imagePath;
        if (file_exists($filePath)) {
            unlink($filePath);
            return new Response(true, "Ảnh đã được xóa khỏi hệ thống");
        }
        return new Response(false, "Ảnh không tồn tại trên hệ thống");
    }

}
