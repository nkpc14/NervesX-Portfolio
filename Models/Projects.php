<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 2:32 PM
 */

require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;
$model->execute();
class Projects extends Model{}
$model = new Projects();
$model->integer("id")->autoIncremented();
$model->string("userid", "255");
$model->string("name", "255");
$model->string("tagline", "255");
$model->string("description", "255");
$model->integer("start");
$model->integer("end");
$model->execute();