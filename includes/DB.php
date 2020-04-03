<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 1/30/2020
 * Time: 4:23 PM
 */

class DB
{
    public $connection;
    private $parameters;
    private $connected = False;
    private $query_string = "";
    private $blindValues = array();
    private $query;
    private $error = FALSE;
    private $results;
    private $count = 0;
    private $lastId;
    private $stmt = null;

    public function __construct($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        $this->createDatabase($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
        $conn = null;
        $this->db_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS);
        $this->parameters = array();
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function db_connect($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        try {
            $this->connection = new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_NAME, $DB_USER, $DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::FETCH_ASSOC);
            $this->connected = TRUE;
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function isConnected()
    {
        return $this->connected;
    }

    public function disconnect()
    {
        $this->connected = FALSE;
        $this->connection = NULL;
    }

    public function createTable($tableName)
    {
//        $this->query();
    }

    public function createDatabase($DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
    {
        try {
            $conn = new PDO("mysql:host=$DB_HOST", $DB_USER, $DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("CREATE DATABASE IF NOT EXISTS $DB_NAME");
        } catch (PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    }

    public function getROW($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
        } catch (PDOException $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    public function query($query)
    {
        $this->query_string = $query;
        $this->execute();
    }

    public function queryWithParams($sql, $parameters = array())
    {
        $this->error = FALSE;
        if ($this->query = $this->connection->prepare($sql)) {
            $i = 1;
            foreach ($parameters as $param) {
                $this->query->bindValue($i, $param);
            }
            if ($this->query->execute()) {
                $this->results = $this->query->fetchAll(PDO::FETCH_ASSOC);
                $this->count = $this->query->rowCount();
                $this->lastId = $this->query->lastInsertedId();
            } else {
                $this->error = TRUE;
            }
        }
    }

    public function insert($keys = [], $values = [], $table)
    {
        $action = "";
        $this->query_string = "";
        if (is_array($keys) and is_array($values)) {
            $action = "INSERT INTO " . $table . " ";
            $keys = implode(",", $keys);
            $values = "'" . implode("','", $values) . "'";
            $action .= "(" . $keys . ") VALUES (" . $values . ")";
        }
        $this->query_string .= $action;
//        echo $this->query_string;
        return $this;
    }

    public function delete_query()
    {
        $this->query_string = "DELETE ";
        return $this;
    }

    public function from($table)
    {
        $this->query_string .= " FROM $table";
        return $this;
    }

    public function select($columns = array())
    {
        $query = "SELECT ";
        if (is_array($columns) and !empty($columns)) {
            $query .= implode(",", $columns);
        } else {
            $query .= "*";
        }
        $this->query_string = $query;
        return $this;
    }

    public function update($table, $set = array())
    {
        $arr = [];
        if (is_array($set) and !empty($set)) {
            $query = "UPDATE $table SET ";
            $count = 0;
            foreach ($set as $key => $value) {
                $arr[$count] = "$key='$value'";
                $count++;
            }
            $query .= implode(",", $arr);
        }
        $this->query_string = $query;
        return $this;
    }

    public function where($where = array())
    {
        $keys = array_keys($where);
        $query = " WHERE ";
        $count = 0;
        if (is_array($where) and !empty($where)) {
            foreach ($where as $key => $value) {
                $arr[$count] = "$key='$value'";
                $count++;
            }
            $query .= implode(" AND ", $arr);
        }
        $this->query_string .= $query;
        return $this;
    }

    public function attributes($atr = array())
    {
        foreach ($atr as $item) {
            $this->query_string .= implode(",", $item);
        }
        return $this;
    }

    public function delete($table, $where)
    {
        $this->from($table)->where($where);
        return $this;
    }

    public function execute()
    {
        if (!empty($this->query_string)) {
            try {
                $this->stmt = null;
                $this->stmt = $this->connection->prepare($this->query_string);
                $this->stmt->setFetchMode(PDO::FETCH_ASSOC);
                $this->stmt->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
                return $this;
            }
        }
        return $this;
    }

    public function get()
    {
        return $this->stmt->fetchAll();
    }

    public function results()
    {
        return $this->results;
    }

    public function first()
    {
        return $this->results[0];
    }

    public function last()
    {
        return $this->results[$this->count - 1];
    }

    public function row($id)
    {
        return $this->results[$id];
    }

    public function error()
    {
        return $this->error;
    }

    public function count()
    {
        return $this->count;
    }

    public function lastId()
    {
        return $this->lastId;
    }

}