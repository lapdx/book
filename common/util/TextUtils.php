<?php

namespace common\util;

use IntlCalendar;

class TextUtils {

    /**
     * 
     * @return string
     */
    public static function randomString() {
        $validCharacters = "abcdefghijklmnopqrstuxyvwz";
        $validCharNumber = strlen($validCharacters);

        $index = mt_rand(0, $validCharNumber - 1);
        $randomCharacter = $validCharacters[$index];

        return $randomCharacter;
    }

    /**
     * 
     * @param type $root
     * @param type $level
     * @param type $genDate
     * @return string
     */
    public static function randomPathfile($root = '', $level = 2, $genDate = true) {
        if ($genDate) {
            $date = getdate();
            $root .= $date["mday"] . '-' .
                    $date["mon"] . '-' .
                    $date["year"] . '/' .
                    $date["hours"] . '/';
        }
        for ($i = 1; $i <= $level; $i ++) {
            $root .= self::randomString() . '/';
        }
        $root = strtolower($root);
        if (!file_exists($root)) {
            mkdir($root, 0755, true);
        }
        return $root;
    }

    /**
     * Kiểm tra sự tồn tại của url
     * @param type $uri
     * @return boolean
     */
    public static function exists($uri) {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $code == 200;
    }

    /**
     * method convert unicode sang không dấu và kí tự đặc biệt
     * Input: string - Doạn chuỗi cần convert
     * @param type $string
     * @return type
     */
    public static function removeMarks($string = "") {
        $string = trim($string);
        $string = str_replace('/', ' ', $string);
        $string = self::StripExtraSpace($string);

        $trans = array('Ầ' => '', '.' => '', '!' => '', '&' => '', '/' => '', '+' => '', '?' => '', '#' => '', "'" => '', ':' => '', "ế" => "e", 'è' => 'e', 'é' => 'e', '‘' => '', '’' => '', '“' => '', '”' => '', 'ẻ' => 'e', 'ẽ' => 'e', 'ằ' => 'a', 'ắ' => 'a', 'ọ' => 'o', 'ẽ' => 'e', 'ờ' => 'o', 'ẹ' => 'e', 'ặ' => 'a', 'ề' => 'e', 'ặ' => 'a', 'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ẫ' => 'a', 'ẩ' => 'a', 'ậ' => 'a', 'ú' => 'a', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'à' => 'a', 'á' => 'a', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ê' => 'e', 'ề' => 'e', 'ể' => 'e', 'ễ' => 'e', 'ệ' => 'e', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ơ' => 'o', 'ớ' => 'o', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ư' => 'u', 'ừ' => 'u', 'ứ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'đ' => 'd', 'À' => 'A', 'Á' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'À' => 'A', 'Ẫ' => 'A', 'Ẩ' => 'A', 'Ậ' => 'A', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ô' => 'O', 'Ố' => 'O', 'Ồ' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ê' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ư' => 'U', 'Ừ' => 'U', 'Ứ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Đ' => 'D', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', 'á' => 'a', 'à' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ú' => 'u', 'ù' => 'u', 'ủ' => 'u', 'ũ' => 'u', 'ụ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'í' => 'i', 'ì' => 'i', 'ỉ' => 'i', 'ĩ' => 'i', 'ị' => 'i', 'ó' => 'o', 'ò' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ố' => 'o', 'ồ' => 'ô', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ơ' => 'o', 'ớ' => 'o', 'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'đ' => 'd', 'Đ' => 'D', 'ý' => 'y', 'ỳ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ỵ' => 'y', 'Á' => 'A', 'À' => 'A', 'Ả' => 'A', 'Ã' => 'A', 'Ạ' => 'A', 'Ă' => 'A', 'Ắ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Â' => 'A', 'Ấ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A', 'Ậ' => 'A', 'É' => 'E', 'È' => 'E', 'Ẻ' => 'E', 'Ẽ' => 'E', 'Ẹ' => 'E', 'Ế' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'Ễ' => 'E', 'Ệ' => 'E', 'Ú' => 'U', 'Ù' => 'U', 'Ủ' => 'U', 'Ũ' => 'U', 'Ụ' => 'U', 'Ư' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'Ử' => 'U', 'Ữ' => 'U', 'Ự' => 'U', 'Í' => 'I', 'Ì' => 'I', 'Ỉ' => 'I', 'Ĩ' => 'I', 'Ị' => 'I', 'Ó' => 'O', 'Ò' => 'O', 'Ỏ' => 'O', 'Õ' => 'O', 'Ọ' => 'O', 'Ô' => 'O', 'Ố' => 'O', 'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ơ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O', 'Ý' => 'Y', 'Ỳ' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y', 'Ỵ' => 'Y', ' ' => '-', 'ề' => 'e', 'ờ' => 'o', '(' => '', ')' => '', ',' => '', '%' => '', 'ồ' => 'o', '_' => '', '=' => '', '"' => '');
        $string = strtolower(strtr(trim($string), $trans));
        $string = self::StripExtraSub($string);
        $string = preg_replace('/\W/', '-', $string);
        return $string;
    }

    /**
     * 
     * @param type $s
     * @return type
     */
    private static function StripExtraSpace($s) {
        $newstr = "";
        for ($i = 0; $i < strlen($s); $i++) {
            $newstr = $newstr . substr($s, $i, 1);
            if (substr($s, $i, 1) == ' ')
                while (substr($s, $i + 1, 1) == ' ')
                    $i++;
        }
        $newstr = ltrim($newstr);
        $newstr = rtrim($newstr);

        return $newstr;
    }

    /**
     * 
     * @param type $s
     * @return type
     */
    private static function StripExtraSub($s) {
        $newstr = "";
        for ($i = 0; $i < strlen($s); $i++) {
            $newstr = $newstr . substr($s, $i, 1);
            if (substr($s, $i, 1) == '-')
                while (substr($s, $i + 1, 1) == '-')
                    $i++;
        }
        $newstr = ltrim($newstr);
        $newstr = rtrim($newstr);

        return $newstr;
    }

    /* End removeMarks */
    /*
     * method cắt chuỗi utf8
     * Input: string, độ dài, kí tự nối tiếp vào string, font, ...,..
     */

    public static function mb_truncate($string, $length = 80, $etc = '...', $charset = 'UTF-8', $break_words = false, $middle = false) {
        if ($length == 0) {
            return '';
        }

        if (strlen($string) > $length) {
            $length -= min($length, strlen($etc));
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length + 1, $charset));
            }
            if (!$middle) {
                return mb_substr($string, 0, $length, $charset) . $etc;
            } else {
                return mb_substr($string, 0, $length / 2, $charset) . $etc . mb_substr($string, -$length / 2, $charset);
            }
        } else {
            return $string;
        }
    }

    /**
     * Phương thức chuẩn hóa dấu cách
     * @param type $str
     * @return type
     */
    public function spaceStandardized($str) {
        while (true) {
            if (strpos($str, '  ') != 0) {
                $str = str_replace('  ', ' ', $str);
            } else {
                break;
            }
        }
        return $str;
    }

    /**
     * Phương thức chuyển từ có chuỗi có dấu sang không dấu
     * @param type $str
     * @return type
     */
    public static function convertToAscii($str) {
        $vnCode = array('à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ', 'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ', 'ì', 'í', 'ị', 'ỉ', 'ĩ', 'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ', 'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ', 'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ', 'đ', 'À', 'Á', 'Ạ', 'Ả', 'Ã', 'Â', 'Ầ', 'Ấ', 'Ậ', 'Ẩ', 'Ẫ', 'Ă', 'Ằ', 'Ắ', 'Ặ', 'Ẳ', 'Ẵ', 'È', 'É', 'Ẹ', 'Ẻ', 'Ẽ', 'Ê', 'Ề', 'Ế', 'Ệ', 'Ể', 'Ễ', 'Ì', 'Í', 'Ị', 'Ỉ', 'Ĩ', 'Ò', 'Ó', 'Ọ', 'Ỏ', 'Õ', 'Ô', 'Ồ', 'Ố', 'Ộ', 'Ổ', 'Ỗ', 'Ơ', 'Ờ', 'Ớ', 'Ợ', 'Ở', 'Ỡ', 'Ù', 'Ú', 'Ụ', 'Ủ', 'Ũ', 'Ư', 'Ừ', 'Ứ', 'Ự', 'Ử', 'Ữ', 'Ỳ', 'Ý', 'Ỵ', 'Ỷ', 'Ỹ', 'Đ');
        $unsignCode = array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y', 'd', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'U', 'Y', 'Y', 'Y', 'Y', 'Y', 'D');
        return str_replace($vnCode, $unsignCode, $str);
    }

    /**
     * Phương thức chuyển đổi từ số sang chuỗi
     * @param type $number
     * @param type $count
     * @return string
     */
    public static function convertNumberToString($number, $count) {
        $countString = strlen($number);
        $numberString = (string) $number;
        $divAddNumber = $count - $countString;
        for ($i = 1; $i <= $divAddNumber; $i++) {
            $numberString = '0' . $numberString;
        }
        return $numberString;
    }

    /**
     * Phương thức chuyển đổi sang giờ dễ hiểu
     * @param type $value
     * @return type
     */
    public static function convertTime($value) {
        $condition = time() - $value;
        $text = '';
        if ($condition >= 0 && $condition <= 5) {
            $text = 'Vừa xong';
        }
        if ($condition > 5 && $condition <= 60) {
            $text = $condition . ' giây trước';
        }
        if ($condition > 60 && $condition <= 3600) {
            $minute = floor($condition / 60);
            $second = $condition - ($minute * 60);
            $text = $minute . ' phút ' . $second . ' giây trước';
        }
        if ($condition > 3600 && $condition <= 86400) {
            $hour = floor($condition / 3600);
            $minute = floor(($condition - ($hour * 3600)) / 60);
            $text = $hour . ' giờ ' . $minute . ' phút trước';
        }
        if ($condition > 86400 && $condition <= 172800) {
            $text = 'Hôm qua, ' . date('H : i', $value);
        }
        if ($condition > 172800 && $condition <= 259200) {
            $text = 'Hôm kia, ' . date('H : i', $value);
        }
        if ($condition > 259200) {
            $text = date('H:i  d/m/Y', $value);
        }
        return $text;
    }

    /**
     * Get Ip client
     * @return type
     */
    public static function getClientIP() {
        if (isset($_SERVER)) {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
                return $_SERVER["HTTP_X_FORWARDED_FOR"];
            if (isset($_SERVER["HTTP_CLIENT_IP"]))
                return $_SERVER["HTTP_CLIENT_IP"];
            return $_SERVER["REMOTE_ADDR"];
        }
        if (getenv('HTTP_X_FORWARDED_FOR'))
            return getenv('HTTP_X_FORWARDED_FOR');
        if (getenv('HTTP_CLIENT_IP'))
            return getenv('HTTP_CLIENT_IP');
        return getenv('REMOTE_ADDR');
    }

    public static function getTimeByDay($time, $day = 0) {

        $cal = IntlCalendar::fromDateTime(date('m/d/Y', $time));
        $actualMaximum = $cal->getActualMaximum(IntlCalendar::FIELD_DAY_OF_MONTH);
        $dayOfMonth = $cal->get(IntlCalendar::FIELD_DAY_OF_MONTH) + $day;
        if ($dayOfMonth > $actualMaximum) {
            $dayOfMonth = $dayOfMonth - $actualMaximum;
            $cal->set(IntlCalendar::FIELD_DATE, $dayOfMonth);
            $cal->set(IntlCalendar::FIELD_MONTH, $cal->get(IntlCalendar::FIELD_MONTH) + 1);
        } else {
            $cal->set(IntlCalendar::FIELD_DATE, $dayOfMonth);
        }
        return $cal->getTime() / 1000;
    }

    /*
     * format money 
     */

    public static function numberFormat($number) {
        return number_format($number, 0);
    }

    /**
     * format percent
     * @param type $number
     * @return type
     */
    public static function percentFormat($number) {
        return ceil($number);
    }

    /**
     * Tính phần trăm giảm giá
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function calPercent($startPrice = 0, $sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0) {
        $percent = 0;
        if (!$discount && $startPrice > $sellPrice) {
            $percent = ($startPrice - $sellPrice) / $startPrice;
        } else {
            if ($startPrice <= $sellPrice) {
                $startPrice = $sellPrice;
            }
            $price = 0;
            if ($discountPercent > 0) {
                $price = (100 - $discountPercent * 1.0);
                $price = $sellPrice * $price / 100;
            } else {
                $price = $sellPrice - $discountPrice;
            }
            $percent = ($startPrice - $price) / $startPrice;
        }
        $percent *= 100;
        $percent = ceil($percent);
        return self::numberFormat($percent);
    }

    /**
     * Tính giá gốc
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @return string
     */
    public static function startPrice($startPrice = 0, $sellPrice = 0, $discount = false) {
        if (!$discount && $startPrice <= $sellPrice) {
            return "0";
        }
        if ($discount && $startPrice <= $sellPrice) {
            $startPrice = $sellPrice;
        }
        if ($startPrice > 0 && $startPrice >= $sellPrice) {
            return self::numberFormat($startPrice * 1.0);
        }
        return "0";
    }

    /**
     * Tính giá bán
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function sellPrice($sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0) {
        if ($discount) {
            if ($discountPercent > 0) {
                $sellPrice = $sellPrice * (100 - $discountPercent) / 100;
            } else {
                $sellPrice = $sellPrice - $discountPrice;
            }
        }
        return self::numberFormat($sellPrice * 1.0);
    }

    /**
     * Tính giá giảm
     * @param type $startPrice
     * @param type $sellPrice
     * @param type $discount
     * @param type $discountPrice
     * @param type $discountPercent
     * @return type
     */
    public static function discountPrice($startPrice = 0, $sellPrice = 0, $discount = false, $discountPrice = 0, $discountPercent = 0) {
        if ($discount && $startPrice <= $sellPrice) {
            $startPrice = $sellPrice;
        }
        if ($discount) {
            if ($discountPercent > 0) {
                $sellPrice = $sellPrice * (100 - $discountPercent) / 100;
            } else {
                $sellPrice = $sellPrice - $discountPrice;
            }
        }
        $price = ($startPrice - $sellPrice) * 1.0;
        $price = ($price > 0 ? $price : 0);
        return self::numberFormat($price);
    }

    /**
     * Get html by url
     * @param type $url
     * @param type $timeout
     * @return type
     */
    public static function getHTML($url, $timeout = 30) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

}
