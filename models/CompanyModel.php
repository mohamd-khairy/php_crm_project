<?php

class CompanyModel extends BasicTable {

    static protected $table_name = "company";
    public $primary_key = "company_id";
    public $fields = array('company_name', 'company_url', 'company_date', 'acc_id', 'company_address',
        'company_phone', 'company_image');
    public $company_name;
    public $company_url;
    public $company_date;
    public $acc_id;
    public $company_address;
    public $company_phone;
    public $company_image;

    static public function get_all_company_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY company_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id . " ORDER BY company_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . "  where acc_id={$_SESSION['acc_id']} and company_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_company_Data_by_name($company) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . "  where acc_id={$_SESSION['acc_id']} and company_name= '$company'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
