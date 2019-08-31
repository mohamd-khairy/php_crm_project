<?php

class AccountModel extends BasicTable {

    static protected $table_name = "account";
    public $primary_key = "acc_id";
    public $fields = array('acc_id', 'role', 'acc_name', 'acc_email', 'acc_password', 'acc_image', 'acc_start_date', 'acc_phone', 'acc_city');
    public $acc_name;
    public $acc_email;
    public $acc_password;
    public $acc_image;
    public $acc_start_date;
    public $acc_phone;
    public $acc_city;
    public $acc_id;
    public $role;

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY acc_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function checkemail($email) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_email='$email'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function checkphone($phone) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_phone='$phone'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function check($e, $p) {
        $m = DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_email='{$e}' and acc_password='{$p}' ")->fetchAll(PDO::FETCH_ASSOC);
        return $m;
    }

}
