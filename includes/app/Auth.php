<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 3:11 PM
 */
require_once __DIR__ . "\../DB.php";
require_once __DIR__ . "\../Security.php";
require_once __DIR__ . "\../FileSystem.php";
session_start();

class Auth
{
    private $db;
    public $loggedIn = false;
    public $isAuthenticated = false;
    private $errors = [];
    private $table;

    public function __construct($table)
    {
        global $db;
        $this->db = $db;
        $this->table = $table;
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION["SSID"])) {

        }
    }

    public function login($POST)
    {
        $POST = Security::clean_post($POST);
        $username = Security::get_instance()->set($POST["username"])->length(5)->filter_string_low()->clean()->get();
        $password = Security::get_instance()->set($POST["password"])->length(5)->filter_string_low()->clean()->get();
        echo "USERNAME " . $username;
        echo "PASSWORD " . $password;
        $password = $_POST["password"];
        $data = $this->db->select()->from("users")->where(["username" => $_POST["username"]])->execute()->get();
        if ($data > 0) {
            $password_sql = $data[0]["password"];
            if (password_verify($password, $password_sql)) {
                $this->loggedIn = true;
                $this->isAuthenticated = true;
                $_SESSION["SSID"] = $data[0]["id"];
            } else {
                $this->isAuthenticated = false;
                array_push($this->errors, "Username or Password incorrect");
                var_dump($this->errors);
            }
        }
    }

    public function signUp($POST)
    {
        $POST = Security::clean_post($POST);
        $firstname = Security::get_instance()->set($POST["firstname"])->clean()->get();
        $lastname = Security::get_instance()->set($POST["lastname"])->clean()->get();
        $email = Security::get_instance()->set($POST["email"])->clean()->filter_email()->get();
        $username = explode("@", $email);
        $username = $username[0];
        $username = Security::get_instance()->set($username)->length(5)->filter_string_low()->clean()->get();
        $password = Security::get_instance()->set($POST["password"])->length(5)->filter_string_low()->clean()->get();
        $mobile = Security::get_instance()->set($POST["mobile"])->clean()->length(10)->get();
        $bio = Security::get_instance()->set($POST["bio"])->clean()->get();
        $zipcode = Security::get_instance()->set($POST["zipcode"])->clean()->valid_int()->get();
        $linkedin = Security::get_instance()->set($POST["linkedin"])->filter_url()->valid_int()->get();
        $github = Security::get_instance()->set($POST["github"])->filter_url()->valid_int()->get();
        $facebook = Security::get_instance()->set($POST["facebook"])->filter_url()->valid_int()->get();
        $instagram = Security::get_instance()->set($POST["instagram"])->filter_url()->valid_int()->get();
        $website = Security::get_instance()->set($POST["website"])->filter_url()->get();

        $data = $this->db->select()->from("users")->where(["username" => $username])->execute()->get();
        if (count($data) > 0) {
            array_push($this->errors, "Username Already Taken");
        }
        if (count($this->errors) == 0) {
            $fs = new FileSystem("uploads", 5000000, ["jpg", "png", "jpeg", "gif"]);
            $profile_photo = $fs->upload("photo", "submit");
            $this->db->insert([
                "username", "firstname", "lastname", "email", "password", "mobile", "bio", "zipcode", "linkedin", "github", "facebook", "instagram", "website", "photo"],
                [
                    $username, $firstname, $lastname, $email, password_hash($password, PASSWORD_DEFAULT), $mobile, $bio, $zipcode, $linkedin, $github, $facebook, $instagram, $website, $profile_photo
                ]
                , "users")->execute();

        } else {
            return $this->errors;
        }
    }

    public function signOut()
    {
        session_destroy();
        $this->isAuthenticated = false;
        header("Location: ./login.php");
    }
}

$auth = new Auth("users");
