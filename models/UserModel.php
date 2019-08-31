<?php

class UserModel extends BasicTable {

    static protected $table_name = "users";
    public $primary_key = "user_id";
    public $fields = array('acc_id','company_id', 'user_job', 'user_name', 'user_date', 'user_password', 'user_email', 'user_phone', 'user_image', 'user_address'
        , 'role', 'user_other');
    public $user_name;
    public $user_password;
    public $user_email;
    public $user_phone;
    public $user_image;
    public $user_address;
    public $role;
    public $user_other;
    public $user_date;
    public $user_job;
    public $company_id;
    public $acc_id;


     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY user_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and user_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getDatabyid_for_cookie($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where user_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function checkemail($email) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and user_email='$email'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function check($e, $p) {
        $m = DatabaseManager::getInstance()->dbh->query("select * from users where user_email='{$e}' and user_password='{$p}' ")->fetchAll(PDO::FETCH_ASSOC);
        return $m;
    }
    static public function get_num_user_in_company($id, $acc) {
        $m = DatabaseManager::getInstance()->dbh->query("select * from users where company_id={$id} and acc_id={$acc} ")->fetchAll(PDO::FETCH_ASSOC);
        return $m;
    }

    static public function get_users_desc($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=".$acc_id." ORDER BY user_id limit 0,15")->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function getAllDatabynumber($number) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and user_phone= '$number'")->fetchAll(PDO::FETCH_ASSOC);
    }
}
