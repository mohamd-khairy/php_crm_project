<?php

class TaskModel extends BasicTable {

    static protected $table_name = "task";
    public $primary_key = "task_id";
    public $fields = array('user_id','task_name', 'task_method', 'task_start_date', 'task_end_date', 'task_periority',
        'acc_id', 'contact_id', 'deal_id', 'other');
    public $task_name;
    public $task_method;
    public $task_start_date;
    public $task_end_date;
    public $task_periority;
    public $acc_id;
    public $contact_id;
    public $deal_id;
    public $other;
    public $task_id;
    public $user_id;
    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY task_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }
        static public function getAllData_by_contact_id_not_equal_null_fornotify($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." and contact_id != '0' ORDER BY task_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function get_all_task_and_contact_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from task,contacts where task.acc_id=$acc_id and task.contact_id=contacts.contact_id ORDER BY task_id DESC limit 0,10")->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function get_all_task_and_user_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from task,users where task.acc_id=$acc_id and task.user_id=users.user_id ORDER BY task_id DESC limit 0,10")->fetchAll(PDO::FETCH_ASSOC);
    }    
    static public function getAllDatabyid($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  task_id=" . $id)->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function getAllDataby_contact_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  contact_id=" . $id ." ORDER BY task_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

       static public function getAllDataby_user_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id={$_SESSION['acc_id']} and  user_id=" . $id ." ORDER BY task_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

     static public function get_count_task_by_method_and_acc_id($method,$acc_id) {
         $n = DatabaseManager::getInstance()->dbh->query("select count(*) as count from task,contacts where task.acc_id=$acc_id and task.task_method= '$method' and task.contact_id=contacts.contact_id")->fetchAll();
        return $n[0];
   
    }
    
     static public function get_task_by_method_acc_id_offset($method,$offset=0,$acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from task,contacts where task.acc_id=$acc_id and task.task_method= '$method' and task.contact_id=contacts.contact_id  limit $offset," . PER_PAGE_COUNT )->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
     static public function get_task_by_method_task_id_acc_id($method,$id,$acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from task,contacts where task.acc_id=$acc_id and task.task_method= '$method' and task.task_id={$id} and task.contact_id=contacts.contact_id")->fetchAll(PDO::FETCH_ASSOC);
    }
    static public function get_task_by_method_task_id_acc_id_user($method,$id,$acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from task,users where task.acc_id=$acc_id and task.task_method= '$method' and task.task_id={$id} and task.user_id=users.user_id")->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
 static public function chechfound($task_id, $user_show_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from notify where acc_id={$_SESSION['acc_id']}  and task_id=" . $task_id . " and user_show_id=" . $user_show_id)->fetchAll(PDO::FETCH_ASSOC);
    }

    

   
   

}
