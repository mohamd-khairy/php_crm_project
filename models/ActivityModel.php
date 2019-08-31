<?php

class ActivityModel extends BasicTable {

    static protected $table_name = "activity";
    public $primary_key = "act_id";
    public $fields = array('type', 'act_details', 'act_datetime', 'user_id', 'acc_id');
    public $act_details;
    public $act_datetime;
    public $user_id;
    public $act_id;
    public $type;
    public $acc_id;

    static public function getAllData_by_acc_id($acc_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where acc_id=" . $acc_id ." ORDER BY act_id DESC" )->fetchAll(PDO::FETCH_ASSOC);
    }
     static public function get_act_by_activity_id_desc($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from activity,users where activity.acc_id={$_SESSION['acc_id']} and activity.act_id={$id} and activity.user_id=users.user_id ")->fetchAll(PDO::FETCH_ASSOC);   }


    static public function get_act_by_user_id_desc($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from activity,users where activity.acc_id={$_SESSION['acc_id']} and activity.user_id={$id} and activity.user_id=users.user_id ORDER BY act_id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_all_activity_user($offset = 0) {
        return DatabaseManager::getInstance()->dbh->query("select * from activity,users where activity.acc_id={$_SESSION['acc_id']} and
                         activity.user_id=users.user_id ORDER BY act_id DESC  limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_all_activity_user_by_date_day($offset,$date) {
        
        return DatabaseManager::getInstance()->dbh->query("select * from activity,users where activity.acc_id={$_SESSION['acc_id']} and  activity.act_datetime='" . $date . "'"
                        . " and   activity.user_id=users.user_id ORDER BY act_id DESC  limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

     static public function chechfound($act_id, $user_show_id) {
        return DatabaseManager::getInstance()->dbh->query("select * from notify where acc_id={$_SESSION['acc_id']}  and act_id=" . $act_id . " and user_show_id=" . $user_show_id)->fetchAll(PDO::FETCH_ASSOC);
    }
}
