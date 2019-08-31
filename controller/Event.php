<?php

class Event {

    private $template;
    private $event;
    private $act;

    public function __construct() {
        $this->template = new Template();
        $this->act = new ActivityModel();
        $this->event = new EventModel();
    }

    function indexAction() {//this cod should take to the page activity , report ....
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            $this->template->msg = -1;
            $this->template->render('user/error');
        } else {
            switch ($_SESSION['role']) {
                case 'admin':

                    $this->template->render('home3');
                    break;
                case 'manager':

                    $this->template->render('home');
                    break;
                case 'user':

                    $this->template->render('home3');
                    break;

                default:
                    $this->template->render('admin/login');
                    break;
            }
        }
    }

     function count_eventAction(){
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
             $data=  EventModel::getAllData_by_acc_id($_SESSION['acc_id']);
              echo count($data);  
        }
    }
    
    
    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['pg']) && intval($_GET['pg'])) {
                $current = $_GET['pg'];
            } else {
                $current = 0;
            }
            $this->template->offset = $current;
            $m = EventModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);

            $this->template->render('event/show');
        }
    }

    function showoneAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $this->template->render('event/showone');
        }
    }

    function exelAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('event/exel');
        }
    }

    function deleteAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['id'])) {
                $this->event->delete($_GET['id'], $_SESSION['acc_id']);

                if (isset($_SESSION['user_id'])) {
                    $data = EventModel::getAllDatabyid($_GET['id']);
                    if (!empty($data)) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = 'من الاحداث' . $data[0]['title'] . '  تم حذف ';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'event';
                        $this->act->insert();
                    }
                }
                echo " <div class='alert alert-danger h4' role='alert'>..تم الحذف.. </div>";
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

    function delete_allAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_SESSION['role']) && $_SESSION['role'] != 'user') {
                $this->event->delete_all(intval($_SESSION['acc_id']));
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'تم حذف كل الايفينتات';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'event';
                    $this->act->insert(); 
                }
                    echo " <div class='alert alert-danger h4' role='alert'>..تم حذف الكل .. </div>";
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

}
?>