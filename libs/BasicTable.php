<?php

class BasicTable {

    static protected $table_name;
    public $primary_key;
    public $fields = array();

    public function __construct() {
        $db = DatabaseManager::getInstance();
        $this->dbh = $db->dbh;
    }

    public function delete($primary_key, $acc_id) {

        return $this->dbh->query("delete from " . static::$table_name . " where " . $this->primary_key . "=$primary_key and acc_id=" . $acc_id);
    }

    

    public function delete_all($acc_id) {

        return $this->dbh->query("delete from " . static::$table_name . " where acc_id=" . $acc_id);
    }

    protected function getFieldsAsString() {
        $sqlStatment = array();
        foreach ($this->fields as $field) {
            $sqlStatment[] = $field . "='" . $this->$field . "'";
        }
        return implode(',', $sqlStatment);
    }

    public function insert() {
        $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
        return $this->dbh->lastInsertId();
    }

    public function insertCompose() {
        return $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
    }

    public function update($primary_key) {
        return $this->dbh->exec("update " . static::$table_name . " set " . $this->getFieldsAsString() . " where " . $this->primary_key . "=" . $primary_key);
    }

    static public function getAll($offset = 0) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . "  limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData() {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id) {
        $m = $this->dbh->query("select * from " . static::$table_name . " where " . $this->primary_key . " =$id")->fetchAll(PDO::FETCH_CLASS, get_called_class());
        return $m[0];
    }

    static public function getCount($acc_id) {
        $n = DatabaseManager::getInstance()->dbh->query("select count(*) as count from " . static::$table_name . " where acc_id=" . $acc_id)->fetchAll();
        return $n[0];
    }

    static public function getorderCount($order) {
        $n = DatabaseManager::getInstance()->dbh->query("select sum($order) as sum from " . static::$table_name)->fetchAll();
        return $n[0];
    }

    static public function search($key, $value) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where   acc_id={$_SESSION['acc_id']} and $key like '%$value%'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
