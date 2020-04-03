<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 4/2/2020
 * Time: 2:43 PM
 */
require_once (__DIR__.'./../includes/Model.php');

use Schema\Model;

class Skills extends Model{}
$model = new Skills();
$model->integer("id")->autoIncremented();
$model->string("userid", "255");
$model->string("name", "255");
$model->integer("score");
$model->execute();