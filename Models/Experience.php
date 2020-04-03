<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 2:33 PM
 */
require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;
class Experience extends Model{}
$model = new Experience();
$model->integer("id")->autoIncremented();
$model->string("userid", "255");
$model->string("title", "255");
$model->string("company", "255");
$model->string("description", "255");
$model->integer("start");
$model->integer("end");
$model->execute();