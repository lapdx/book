<?php

namespace common\models\business;

use common\models\db\AuthAssignment;
use common\models\db\AuthItem;
use common\models\db\AuthItemChild;
use common\models\db\AuthItemGroup;
use common\util\FileUtils;
use ReflectionClass;

class FunctionBusiness {

    public static $root = "../../backend/controllers/service";

    public static function getServices() {
        $files = FileUtils::read_all_files(self::$root);
        $namespace = [];
        $rewriteRule = [];
        foreach ($files['files'] as $file) {
            require_once $file;
            $phpFile = self::readClass($file);
            foreach ($phpFile as $nspace => $className) {
                $cl = @$namespace[$nspace];
                if ($cl == null) {
                    $cl = [];
                }
                $namespace[$nspace] = array_merge($cl, $className);
            }
        }
        $func = [];
        foreach ($namespace as $nspace => $classNames) {
            $file = explode("\\", $nspace);
            $file = end($file);
            foreach ($classNames as $className) {
                $class = new ReflectionClass($nspace . "\\" . $className);
                $controllerName = explode("\\", $class->getName());
                $controllerName = strtolower(explode("Controller", end($controllerName))[0]);
                if ($controllerName == 'service')
                    continue;
                $func[$controllerName] = [];
                foreach ($class->getMethods() as $method) {
                    $method = strtolower($method->getName());
                    if (preg_match('/^action/', $method) && $method != 'actions') {
                        $func[$controllerName][] = $controllerName . "_" . explode("action", $method)[1];
                    }
                }
            }
        }
        return $func;
    }

    private static function readClass($file) {
        $class = [];
        if (file_exists($file)) {
            $php_code = file_get_contents($file);
            $class = self::get_php_classes($php_code);
        }
        return $class;
    }

    private static function get_php_classes($phpcode) {
        $classes = array();

        $namespace = 0;
        $tokens = token_get_all($phpcode);
        $count = count($tokens);
        $dlm = false;
        for ($i = 2; $i < $count; $i++) {
            if ((isset($tokens[$i - 2][1]) && ($tokens[$i - 2][1] == "phpnamespace" || $tokens[$i - 2][1] == "namespace")) ||
                    ($dlm && $tokens[$i - 1][0] == T_NS_SEPARATOR && $tokens[$i][0] == T_STRING)) {
                if (!$dlm)
                    $namespace = 0;
                if (isset($tokens[$i][1])) {
                    $namespace = $namespace ? $namespace . "\\" . $tokens[$i][1] : $tokens[$i][1];
                    $dlm = true;
                }
            } elseif ($dlm && ($tokens[$i][0] != T_NS_SEPARATOR) && ($tokens[$i][0] != T_STRING)) {
                $dlm = false;
            }
            if (($tokens[$i - 2][0] == T_CLASS || (isset($tokens[$i - 2][1]) && $tokens[$i - 2][1] == "phpclass")) && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                if (!isset($classes[$namespace]))
                    $classes[$namespace] = array();
                $classes[$namespace][] = $class_name;
            }
        }
        return $classes;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getAuthGroupById($id) {
        return AuthItemGroup::findOne($id);
    }

    /**
     * 
     * @return type
     */
    public static function getAuthGroup() {
        return AuthItemGroup::find()->orderBy("position")->all();
    }

    /**
     * 
     * @return type
     */
    public static function getAuthItem() {
        return AuthItem::find()->all();
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public static function getAuthItemByName($name) {
        return AuthItem::findOne(["name" => $name]);
    }

    /**
     * 
     * @return type
     */
    public static function getAuthItemChilds() {
        return AuthItemChild::find()->all();
    }

    /**
     * 
     * @param type $parent
     * @param type $child
     * @return type
     */
    public static function getAuthItemChildsByPrimarykey($parent, $child) {
        return AuthItemChild::findOne(["parent" => $parent, "child" => $child]);
    }

    /**
     * 
     * @param type $userId
     * @return type
     */
    public static function getAssignmentByUserId($userId) {
        return AuthAssignment::find()->where(["user_id" => $userId])->all();
    }

    /**
     * 
     * @param type $userId
     * @return type
     */
    public static function removeAssignmentByUserId($userId) {
        return AuthAssignment::deleteAll(["user_id" => $userId]);
    }

}
