<?php

class EventModel extends BasicTable {

    static protected $table_name = "events";
    public $primary_key = "id";
    public $fields = array('title', 'date', 'created', 'modified', 'user_id', 'acc_id','company');
    public $title;
    public $date;
    public $created;
    public $modified;
    public $user_id;
    public $acc_id;
    public $company;

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_company_name($company_name) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  company='{$company_name}'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
