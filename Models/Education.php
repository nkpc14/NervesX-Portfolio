<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/22/2020
 * Time: 8:45 PM
 */

require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;
$model->execute();
class Education extends Model{}
$model = new Education();
$model->integer("id")->autoIncremented();
$model->integer("userid");
$model->string("degree", "255");
$model->string("college", "255");
$model->integer("start");
$model->integer("end");
$model->execute();