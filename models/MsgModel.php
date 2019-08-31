<?php

class MsgModel extends BasicTable {

    static protected $table_name = "msg";
    public $primary_key = "msg_id";
    public $fields = array('msg_id', 'msg_content', 'acc_id', 'speak_id', 'msg_datetime','chat_id');
    public $msg_id;
    public $msg_content;
    public $acc_id;
    public $speak_id;
    public $msg_datetime;
    public $chat_id;

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and msg_id=" . $id )->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY msg_id ASC" )->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_chat_id($chat_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and chat_id=" . $chat_id )->fetchAll(PDO::FETCH_ASSOC);
    }
   
     static public function getAllDataby_chat_id_DESC($chat_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and chat_id=" . $chat_id." ORDER BY msg_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }

      static public function deletemsg($chat_id) {
        return DatabaseManager::getInstance()->dbh->query("delete * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and chat_id=" . $chat_id)->fetchAll(PDO::FETCH_ASSOC);
    }
}
