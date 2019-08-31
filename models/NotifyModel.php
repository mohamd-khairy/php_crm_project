<?php

class NotifyModel extends BasicTable {

    static protected $table_name = "notify";
    public $primary_key = "notify_id";
    public $fields = array('task_id', 'email_id', 'acc_id', 'act_id', 'user_show_id');
    public $notify_id;
    public $act_id;
    public $user_show_id;
    public $acc_id;
    public $task_id;
    public $email_id;

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and act_id=" . $id )->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY notify_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid_email($id, $user_login) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and email_id=" . $id . " and user_show_id={$user_login}")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDatabyid_task($id, $user_login) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and task_id=" . $id . " and user_show_id={$user_login}")->fetchAll(PDO::FETCH_ASSOC);
    }

}
