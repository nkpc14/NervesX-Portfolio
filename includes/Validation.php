<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 6:26 PM
 */
require_once './Security.php';

class Validation
{
    public $data = '';
    private static $errors = array();
    private static $instance;

    private function __construct()
    {
    }

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new Validation();
            return self::$instance;
        }
    }

    public static function clean($value)
    {
        $data = $value;
        global $security;
        $security->clean($data);
        return self::class;
    }


}