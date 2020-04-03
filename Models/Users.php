<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/22/2020
 * Time: 8:45 PM
 */

require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;
class Users extends Model{}
$model = new Users();
$model->integer("id")->autoIncremented();
$model->string("firstname", "255");
$model->string("lastname", "255");
$model->string("username", "255");
$model->string("photo", "255");
$model->string("password", "512");
$model->integer("mobile");
$model->string("email", "255");
$model->string('bio',"255");
$model->integer('zipcode');
$model->string('linkedin',"512");
$model->string('github',"512");
$model->string('facebook',"512");
$model->string('instagram',"512");
$model->string('website',"512");
$model->execute();