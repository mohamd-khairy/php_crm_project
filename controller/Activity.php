<?php

class Activity {

    private $template;
    private $act;
    private $noti;

    public function __construct() {
        $this->template = new Template();
        $this->act = new ActivityModel();
        $this->noti = new NotifyModel();
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

    function notiyajaxAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $data = ActivityModel::getAllData_by_acc_id($_SESSION['acc_id']);
            foreach ($data as $act) {
                $activity = NotifyModel::getAllDatabyid($act['act_id']);
                if (empty($activity)) {
                    echo'<li>
                                <a href="?rt=Activity/showone&act_id=' . $act['act_id'] . '">
                                    <i class="fa fa-user text-red"></i> ' . $act['act_details'] . '
                                 </a>
                       </li>';
                }
            }
        }
    }

    function count_notyAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $data = ActivityModel::getAllData_by_acc_id($_SESSION['acc_id']);
            echo count($data);
        }
    }

    function count_show_notyAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $data = ActivityModel::getAllData_by_acc_id($_SESSION['acc_id']);
            $i = 0;
            foreach ($data as $act) {
                $activity = NotifyModel::getAllDatabyid($act['act_id']);
                if (empty($activity)) {
                    $i++;
                }
            }
            echo $i;
        }
    }

    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($_SESSION['role'] == 'manager') {
                if (isset($_GET['pg']) && intval($_GET['pg'])) {
                    $current = $_GET['pg'];
                } else {
                    $current = 0;
                }
                $this->template->offset = $current;
                $m = ActivityModel::getCount($_SESSION['acc_id']);
                $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);
                $this->template->render('activity/show');
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

    function showoneAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['act_id'])) {
                $act = $this->noti->act_id = intval($_GET['act_id']);
                $user = $this->noti->user_show_id = $_SESSION['acc_id'];
                $this->noti->acc_id = $_SESSION['acc_id'];
                $this->noti->task_id = 0;
                $this->noti->email_id = 0;
                $data = ActivityModel::chechfound($act, $user);
                if (empty($data)) {
                    if ($this->noti->insert() >= 1) {
                        $this->template->render('activity/showone');
                    } else {
                        $this->template->msg = -1;
                        $this->template->render('errors');
                    }
                }
                $this->template->render('activity/showone');
            }
        }
    }

    function delete_allAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->act->delete_all($_SESSION['acc_id']);
            $this->noti->delete_all($_SESSION['acc_id']);
            header('location:index.php?rt=Activity/show');
        }
    }

    function deleteAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['act_id'])) {
                $this->act->delete(intval($_GET['act_id']), $_SESSION['acc_id']);
                $data = NotifyModel::getAllDatabyid(intval($_GET['act_id']));
                $this->noti->delete(intval($data[0]['notify_id']), $_SESSION['acc_id']);
                header('location:index.php?rt=Activity/show');
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

}
?>

