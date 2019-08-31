<?php

class ContactModel extends BasicTable {

    static protected $table_name = "contacts";
    public $primary_key = "contact_id";
    public $fields = array('contact_id', 'contact_name', 'contact_job', 'contact_email', 'contact_phone'
        , 'contact_address', 'company_id', 'acc_id', 'contact_other', 'contact_date');
    public $contact_name;
    public $contact_job;
    public $contact_email;
    public $contact_phone;
    public $contact_address;
    public $company_id;
    public $acc_id;
    public $contact_other;
    public $contact_date;
    public $contact_id;

     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY contact_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }
    
    static public function get_num_contact_in_company($id, $acc) {
        $m = DatabaseManager::getInstance()->dbh->query("select * from contacts where company_id={$id} and acc_id={$acc}")->fetchAll(PDO::FETCH_ASSOC);
        return $m;
    }

    static public function checkemail($email) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and contact_email='$email'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  contact_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

   
    static public function getAllDatabynumber($number) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and   contact_phone= '$number'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
