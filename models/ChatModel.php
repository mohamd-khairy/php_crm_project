<?php

class ChatModel extends BasicTable {

    static protected $table_name = "chat";
    public $primary_key = "chat_id";
    public $fields = array('chat_id', 'speak1_id', 'speak2_id', 'chat_datetime', 'acc_id');
    public $chat_id;
    public $speak1_id;
    public $acc_id;
    public $speak2_id;
    public $chat_datetime;

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and chat_id=" . $id )->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY chat_id ASC" )->fetchAll(PDO::FETCH_ASSOC);
    }
static public function check($s1, $s2) {
        $m = DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and speak1_id='{$s1}' and speak2_id='{$s2}' ")->fetchAll(PDO::FETCH_ASSOC);
        return $m;
    }
   
}
