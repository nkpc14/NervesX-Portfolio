<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 3:00 PM
 */


class CSRF
{

    public static $key;
    private $token;

    public function store_in_session($key, $value)
    {
        if (isset($_SESSION)) {
            $_SESSION[$key] = $value;
        }
    }

    public function unset_session($key)
    {
        $_SESSION[$key] = ' ';
        unset($_SESSION[$key]);
    }

    public function get_from_session($key)
    {

        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function csrfguard_generate_token($unique_from_name)
    {
        $this->token = random_bytes(64); //PHP 7 paragonie/random_compat
        store_in_session($unique_from_name);
        return $token;
    }

    public function csrfguard_validate_token($unique_from_name, $token_value)
    {

        $this->token = get_from_session($unique_from_name);
        if (!is_string($token_value)) {
            return false;
        }
        $result = hash_equals($token, $token_value);
        unset_session($unique_from_name);
        return $result;
    }

    public function csrfguard_replace_forms($form_data_html)
    {
        $count = $count = preg_match_all("/<form(.*?)>(.*?)<\\/form>/is", $form_data_html, $matches, PREG_SET_ORDER);

        if (is_array($matches)) {
            foreach ($matches as $m) {
                if (strpos($m[1], "nocsrf") !== false) {
                    continue;
                }
                $name = "CSRFGuard" . mt_rand(0, mt_getrandmax());
                $token = csrfguard_generate_token($name);
                $form_data_html = str_replace($m[0], "<form{$m[1]}>
                <input type='hidden' name='CSRFName' value='{$name}' />
                <input type='hidden' name='CSRFToken' value='{$token}' />{$m[2]}</form>",
                    $form_data_html);
            }
        }
        return $form_data_html;

    }

    public function csrfguard_inject()
    {
        $data = ob_get_clean();
        $data = csrfguard_replace_forms($data);
        echo $data;
    }


    public function csrfguard_start()
    {
        if (count($_POST)) {
            if (!isset($_POST['CSRFName']) or !isset($_POST['CSRFToken'])) {
                trigger_error("No CSRFName found, probable invalid request.", E_USER_ERROR);
            }
            $name = $_POST['CSRFName'];
            $token = $_POST['CSRFToken'];
            if (!csrfguard_validate_token($name, $token)) {
                throw new Exception("Invalid CSRF token.");
            }
        }
        ob_start();
        /* adding double quotes for "csrfguard_inject" to prevent:
            Notice: Use of undefined constant csrfguard_inject - assumed 'csrfguard_inject' */
        register_shutdown_function("csrfguard_inject");
    }

}