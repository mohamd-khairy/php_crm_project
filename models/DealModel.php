<?php

class DealModel extends BasicTable {

    static protected $table_name = "deal";
    public $primary_key = "deal_id";
    public $fields = array('deal_user','deal_name','deal_value', 'deal_start_date', 'deal_end_date', 'contact_id',
        'user_id','acc_id', 'other');
    public $deal_name;
    public $deal_value;
    public $deal_start_date;
    public $deal_end_date;
    public $contact_id;
    public $acc_id;
    public $other;
    public $deal_user;
    public $user_id;
    

 static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY deal_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }

 static public function getAllDataby_contact_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  contact_id=" . $id ." ORDER BY deal_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDataby_user_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  user_id=" . $id ." ORDER BY deal_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  deal_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
  
}
