<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 3:02 PM
 */

class XSS
{
    //xss mitigation functions
    public static function xssafe($data, $encoding = 'UTF-8')
    {
        return htmlspecialchars($data, ENT_QUOTES | ENT_HTML401, $encoding);
    }

    public static function xecho($data)
    {
        echo xssafe($data);
    }
}
