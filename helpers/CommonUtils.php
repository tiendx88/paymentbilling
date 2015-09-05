<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 9/2/15
 * Time: 12:17 PM
 */

namespace app\helpers;


class CommonUtils {
    /**
     * tiendx
     * sql injection
     *
     * @param $param
     * @return string
     */
    public static function replace_string_injection($param) {
        if (empty($param)) return $param;
        $param = str_replace("\\", "\\\\\\", $param);
        $param = str_replace("'", "\'", $param);
        $param = str_replace("%", "\%", $param);
        return $param;
    }
} 