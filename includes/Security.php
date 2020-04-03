<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 2:59 PM
 */

class Security
{
    private $data = '';
    private $errors = array();
    private static $instance = null;

    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new Security();
        }
        return self::$instance;
    }

    public function get()
    {
        return $this->data;
    }

    public function set($data)
    {
        $this->data = $data;
        return $this;
    }

    public function clean()
    {

        $cleaned = trim($this->data);
        $cleaned = strip_tags($cleaned);
//        $cleaned = $this->escape_string($data);
        return $this;
    }

//    public function escape_string($data){
//        return mysqli_real_escape_string($data);
//    }

    public static function clean_post($POST)
    {
        return filter_var_array($POST, FILTER_SANITIZE_STRING);
    }

    public function filter_email()
    {
        $this->data = filter_var($this->data, FILTER_SANITIZE_EMAIL);
        return $this;

    }

    public function filter_url()
    {
        $this->data = filter_var($this->data, FILTER_SANITIZE_URL);
        return $this;

    }

    public function trim_data()
    {
        $this->data = trim($this->data);
        return $this;
    }

    public function valid_int()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_INT);
        return $this;
    }

    public function valid_email()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_EMAIL);
        return $this;
    }

    public function valid_url()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_URL);
        return $this;
    }

    public function valid_ip()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_IP);
        return $this;
    }

    //CHECK IF THE INTEGER IS IN THE RANGE
    public function filter_range($min, $max)
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_INT, array(
            "options" => array(
                "min_range" => $min,
                "max_range" => $max)
        ));
        return $this;
    }

    public function valid_ip6()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
        return $this;
    }

    public function valid_ip4()
    {
        $this->data = filter_var($this->data, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        return $this;
    }

    //Removes characters > 127
    public function filter_string_high()
    {
        $this->data = filter_var($this->data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
        return $this;
    }

    //Removes characters < 127
    public function filter_string_low()
    {
        $this->data = filter_var($this->data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        return $this;
    }

    //VALIDATIONS
    public function length($length)
    {
        if (strlen($this->data) < $length) {
            array_push($this->errors, "length can't be less than $length character");
        }
        return $this;
    }

    public function min_max($min, $max)
    {
        if (strlen($this->data) > $max || strlen($this->data) < $min) {
            array_push($this->errors, "length can't be less than $min and greater than $max character");
        }
        return $this;
    }
}

