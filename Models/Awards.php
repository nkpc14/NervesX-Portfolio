<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 2:44 PM
 */
require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;
class Awards extends Model{}
$model = new Awards();
$model->integer("id")->autoIncremented();
$model->string("userid", "255");
$model->string("title", "255");
$model->string("description", "255");
$model->integer("start");
$model->integer("end");
$model->execute();