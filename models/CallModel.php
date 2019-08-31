<?php

class CallModel extends BasicTable {

    static protected $table_name = "calls";
    public $primary_key = "call_id";
    public $fields = array('user_id', 'acc_id', 'call_number', 'call_date', 'call_title', 'contact_id');
    public $call_date;
    public $call_title;
    public $contact_id;
    public $call_number;
    public $acc_id;
    public $user_id;

    static public function getAllData_by_contact_id_not_equal_null_fornotify($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " and contact_id != '0' ORDER BY call_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY call_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and call_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatacall($offset) {
        return DatabaseManager::getInstance()->dbh->query("select * from calls,contacts where calls.acc_id={$_SESSION['acc_id']}  and calls.contact_id=contacts.contact_id limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatacall_user($offset) {
        return DatabaseManager::getInstance()->dbh->query("select * from calls,users where calls.acc_id={$_SESSION['acc_id']}  and calls.user_id=users.user_id limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getcall_by_contact_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from calls,contacts where calls.acc_id={$_SESSION['acc_id']} and calls.contact_id=$id and calls.contact_id=contacts.contact_id ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatacallby_user_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from calls,users where calls.acc_id={$_SESSION['acc_id']}  and calls.user_id=$id and calls.user_id=users.user_id")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatacallby__user($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from calls,users,company where calls.acc_id={$_SESSION['acc_id']}  and calls.call_id=$id and calls.user_id=users.user_id and users.company_id=company.company_id ")->fetchAll(PDO::FETCH_ASSOC);
    }

}
