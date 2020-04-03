<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 1/30/2020
 * Time: 4:21 PM
 */
//require_once 'includes/DB.php';
require_once 'Models/Users.php';
require_once 'includes/Model.php';
require_once 'includes/FileSystem.php';
require_once 'includes/app/Auth.php';

//$db->insert(["username", "email", "password", "mobile"], ["nkpc14", "nkpc14@gmail.com", password_hash("123", PASSWORD_DEFAULT), 7376977077], "users")->execute();
//$db->delete("users", "id=1");
//echo $db->select(["username", "password"])->from("users")->execute();
//$db->update("users",["username"=>"nkpc14","password"=>"new_password"])->where(["username"=>"test"])->execute();
//print_r($db->select([])->from("users")->execute()->get());
//if(isset($_POST["submit"])){
//    $fs = new FileSystem("images", 5000000, ["jpg", "png", "jpeg", "gif"]);
//    $fs->upload("image", "submit");
//}

//echo '
//<form action="" method="post" enctype="multipart / form - data">
//    Select image to upload:
//    <input type="file" name="image" id="image">
//    <input type="submit" value="Upload Image" name="submit">
//</form>';
//$auth->login("nkpc14", "1234");
//$auth->signUp("Nitish", "Kumar", "nkpc14@gmail.com", "1234", 7007675558);