<?php

namespace Source\Database;

class Db
{
    private static $instance = null;
    private $conn ,$table ,$query;

    private function __construct()
    {
        $this->conn = new \mysqli(DB_SERVERNAME ,DB_USERNAME ,DB_PASSWORD ,DB_DATABASE);
        ($this->conn->connect_error)? die("Connection failed ". $this->conn->connect_error) : null;
    }
    
    public static function getInstance()
    {
        return (!self::$instance)? self::$instance = new self : self::$instance;
    }

    public function table(string $table)
    {
        $this->table = $table;
        $this->query = '';
        return $this;
    }

    public function select(string $fields = "*")
    {
        $this->query = "SELECT $fields FROM `$this->table`";
        return $this;
    }

    public function get()
    {
        $result = $this->conn->query($this->query);
        return ($result->num_rows > 0)? $result->fetch_all(MYSQLI_ASSOC) : [] ;
    }

    public function getOne()
    {
        $this->query .= " LIMIT 1";
        $result = $this->conn->query($this->query);

        return ($result->num_rows > 0)? $result->fetch_assoc() : [];
    }

    public function insert(array $data)
    {
        $keys   = [];
        $values = [];

        foreach($data as $key => $value){
            $keys[] = "`".$this->conn->real_escape_string($key)."`";
            $values[] = "'".$value."'";
        }

        $keys = implode(',',$keys);
        $values = implode(',',$values);
        $this->query = "INSERT INTO `$this->table` ($keys) VALUES ($values) ";
        return $this;
    }

    public function update(array $data)
    {
        $sets = [];
        foreach($data as $key => $value){
            $sets[] = "`".$this->conn->real_escape_string($key)."`"."="."'".$value."'";
        }
        $sets = implode(',',$sets);
        $this->query = "UPDATE `$this->table` SET $sets";
        return $this;
    }

    public function delete()
    {
        $this->query = "DELETE FROM `$this->table`";
        return $this;
    }

    public function save()
    {
        return $this->conn->query($this->query);
    }

    public function where(string $field ,string $operation ,$value)
    {
        $this->query .=" WHERE `$field` $operation '$value'";
        return $this;
    }

    public function whereIn(string $field, array $values)
    {
        $values = "(" . implode(",", $values) . ")";
        $this->query .= " WHERE `$field` IN $values";
        return $this;
    }

    public function logic_where(string $logic ,string $field, string $operation, $value)
    {
        $this->query .= " $logic `$field` $operation '$value'";
        return $this;
    }

    public function orderBy(string $field, string $dir = "ASC")
    {
        $this->query .= " ORDER BY `$field` $dir";
        return $this;
    }

    public function limit(int $num)
    {
        $this->query .= " LIMIT $num"; 
        return $this;
    }


    public function innerJoin($table_fields_Array, $fromTable, $onArray)
    {
        $columns = '';
        $on ='';

        foreach($table_fields_Array as $table => $fields) {
            foreach($fields as $field) {
               $alias = trim($table, "s") . "_" . $field;
               $columns .= "$table.$field AS $alias, ";
            }
        }

        foreach($onArray as $table => $conds) {
            foreach($conds as $left => $right) {
                $on .= " JOIN $table ON $left = $right";
            }
        }

        $columns = substr($columns,0,-2);
        $this->query = "SELECT $columns FROM $fromTable $on";
        
        return $this;
    }

    public function saveAndGetId()
    {
       return ($this->conn->query($this->query))? $this->conn->insert_id : null;
    }

}