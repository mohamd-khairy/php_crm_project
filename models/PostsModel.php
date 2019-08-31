<?php

class PostsModel extends BasicTable {

    static protected $table_name = "posts";
    public $primary_key = "post_id";
    public $fields = array('post_id', 'post_content', 'acc_id', 'user_id', 'post_datetime');
    public $post_id;
    public $post_content;
    public $acc_id;
    public $user_id;
    public $post_datetime;

    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and post_id=" . $id )->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY post_id ASC" )->fetchAll(PDO::FETCH_ASSOC);
    }

   
}
