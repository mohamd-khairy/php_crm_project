<?php

class EmailModel extends BasicTable {

    static protected $table_name = "email";
    public $primary_key = "email_id";
    public $fields = array('user_id', 'acc_id', 'email_content', 'email_email', 'email_date', 'contact_id', 'email_attach');
    public $email_content;
    public $contact_id;
    public $email_email;
    public $email_attach;
    public $acc_id;
    public $email_date;
    public $email_id;
    public $user_id;

    static public function getAllData_by_contact_id_not_equal_null_fornotify($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " and contact_id != '0' ORDER BY email_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_contact_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  contact_id=" . $id . " ORDER BY email_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDataby_user_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  user_id=" . $id . " ORDER BY email_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  email_id= {$id} ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function chechfound($email_id, $user_show_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from notify where acc_id={$_SESSION['acc_id']}  and email_id=" . $email_id . " and user_show_id=" . $user_show_id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataemail() {
        return DatabaseManager::getInstance()->dbh->query("select * from email,contacts where email.acc_id={$_SESSION['acc_id']} and  email.contact_id=contacts.contact_id")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY email_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

}
