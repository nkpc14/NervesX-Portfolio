<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 2:34 PM
 */

class Sessions
{
    public $session_id;

    public function __construct($session_id)
    {
        $this->session_id = password_hash(PASSWORD_DEFAULT, $session_id);
    }

    public function setSession()
    {
        $_SESSION["SSID"] = $this->session_id;
        session_start();
    }

    public function destroySession()
    {

    }
}