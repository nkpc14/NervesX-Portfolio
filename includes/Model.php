<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/22/2020
 * Time: 8:29 PM
 */

namespace Schema;
require_once "DB.php";


class Model
{
    private $queryString = "";
    private $SQL_CONNECTION;
    private $tableName;
    private $columns = [];

    public function __construct()
    {
        global $db;
        $this->SQL_CONNECTION = $db->connection;
        $this->tableName = get_class($this);
    }

    public function createTable()
    {
    }

    public function string($name, $value)
    {
        $query = "$name VARCHAR($value)";
        array_push($this->columns, $query);
        return $this;
    }

    public function integer($name)
    {
        $query = "$name BIGINT";
        array_push($this->columns, $query);
        return $this;
    }

    public function timestamp($date)
    {
        return $this;

    }

    public function execute()
    {
        $this->queryString = "CREATE TABLE IF NOT EXISTS $this->tableName (";
        $this->queryString .= implode(",", $this->columns);
        $this->queryString .= ")";
        $this->SQL_CONNECTION->exec($this->queryString);
    }

    public function autoIncremented()
    {
        $column = $this->columns[count($this->columns) - 1];
        $name = explode(" ", $column)[0];
        $this->columns[count($this->columns) - 1] = $column . " AUTO_INCREMENT, primary key($name)";
        return $this;
    }
}

$db = new \DB("localhost", "portfolio", "root", "");
