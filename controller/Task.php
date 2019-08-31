<?php

class Task {

    private $template;
    private $user;
    private $task;
    private $act;
    private $valid;
    private $noti;

    public function __construct() {
        $this->template = new Template();
        $this->user = new UserModel();
        $this->task = new TaskModel();
        $this->act = new ActivityModel();
        $this->valid = new Validation();
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

    function count_task_showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $i = 0;
            if ($_SESSION['role'] != 'user') {
                $data = TaskModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $data = TaskModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            foreach ($data as $task) {
                if ($task['acc_id'] == $_SESSION['acc_id']) {
                    if (isset($_SESSION['user_id'])) {
                        $tasks = NotifyModel::getAllDatabyid_task($task['task_id'], $_SESSION['user_id']);
                    } else {
                        $tasks = NotifyModel::getAllDatabyid_task($task['task_id'], $_SESSION['acc_id']);
                    } if (empty($tasks)) {
                        $i++;
                    }
                }
            }
            echo $i;
        }
    }

    function task_showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($_SESSION['role'] != 'user') {
                $data = TaskModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $data = TaskModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            foreach ($data as $task) {
                if (!isset($_SESSION['user_id'])) {
                    $tasks = NotifyModel::getAllDatabyid_task($task['task_id'], $_SESSION['acc_id']);
                } else {
                    $tasks = NotifyModel::getAllDatabyid_task($task['task_id'], $_SESSION['user_id']);
                }
                if (empty($tasks)) {
                    echo '<li><!-- Task item -->
                            <a href="index.php?rt=Task/showone&m=' . $task['task_method'] . '&task_id=' . $task['task_id'] . '">
                                <h3>';
                    if ($task['contact_id'] != 0) {
                        $t = ContactModel::getAllDatabyid($task['contact_id']);
                        if (!empty($t))
                            echo $t[0]['contact_name'];
                    }else {
                        $t = UserModel::getAllDatabyid($task['user_id']);
                        if (!empty($t))
                            echo $t[0]['user_name'];
                    }
                    if ($task['task_periority'] == 'hard') {
                        echo '<small class="pull-right"><span class="badge bg-red">' . $task['task_method'] . '</span></small>';
                    } elseif ($task['task_periority'] == 'normal') {
                        echo '<small class="pull-right"><span class="badge bg-orange">' . $task['task_method'] . '</span></small>';
                    } else {
                        echo '<small class="pull-right"><span class="badge bg-green">' . $task['task_method'] . '</span></small>';
                    }
                    echo '</h3>
                                <small> <p>' . $task['task_name'] . '</p></small>
                            </a>
                        </li>';
                }
            }
        }
    }

    function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                try {
                    $rules = array(
                        "task_name" => "checkempty",
                        "task_start_date" => "checkempty|checkdate",
                        "task_end_date" => "checkempty|checkdate",
                        "contact_id" => "checkempty",
                        "other" => "checktext"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }

                    $name = $this->task->task_name = $_POST['task_name'];
                    $method = $this->task->task_method = trim($_POST['task_method']);
                    $this->task->task_start_date = $_POST['task_start_date'];
                    $this->task->task_end_date = $_POST['task_end_date'];
                    $this->task->task_periority = $_POST['task_periority'];
                    $this->task->contact_id = $_POST['contact_id'];
                    $this->task->user_id = 0;
                    $this->task->acc_id = $_POST['acc_id'];
                    $this->task->deal_id = $_POST['deal_id'];
                    $this->task->other = $_POST['other'];
                    if ($this->task->insert() >= 1) {
                        if (isset($_SESSION['user_id'])) {
                            $this->act->act_datetime = date(DateTime::ATOM);
                            $this->act->act_details = $name . 'تم اضافه مهمه جديد ';
                            $this->act->user_id = $_SESSION['user_id'];
                            $this->act->acc_id = $_SESSION['acc_id'];
                            $this->act->type = 'task';
                            $this->act->insertCompose();
                        }
                        //$this->template->msg = 1;
                        if ($method == 'email') {
                            $this->template->msg = 3;
                            $this->template->render("email/add");
                        } elseif ($method == 'call') {
                            $this->template->msg = 3;
                            $this->template->render("call/add");
                        } else {
                            $this->template->msg = 1;
                            $this->template->render("task/addnew");
                        }
                    } else {
                        $this->template->msg = -1;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("task/addnew");
                }
            }
        }
        $this->template->render("task/addnew");
    }

    function adduserAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                try {
                    $rules = array(
                        "task_name" => "checkempty|checktext",
                        "task_start_date" => "checkempty|checkdate",
                        "task_end_date" => "checkempty|checkdate",
                        "user_id" => "checkempty",
                        "other" => "checktext"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }

                    $name = $this->task->task_name = $_POST['task_name'];
                    $method = $this->task->task_method = $_POST['task_method'];
                    $this->task->task_start_date = $_POST['task_start_date'];
                    $this->task->task_end_date = $_POST['task_end_date'];
                    $this->task->task_periority = trim($_POST['task_periority']);
                    $this->task->contact_id = 0;
                    $this->task->user_id = (int) $_POST['user_id'];
                    $this->task->acc_id = (int) $_POST['acc_id'];
                    $this->task->deal_id = (int) $_POST['deal_id'];
                    $this->task->other = $_POST['other'];
                    if ($this->task->insert() >= 1) {
                        if (isset($_SESSION['user_id'])) {
                            $this->act->act_datetime = date(DateTime::ATOM);
                            $this->act->act_details = 'تم اضافه مهمه جديد => ' . $name;
                            $this->act->user_id = $_SESSION['user_id'];
                            $this->act->acc_id = $_SESSION['acc_id'];
                            $this->act->type = 'task';
                            $this->act->insertCompose();
                        }
                        if ($method == 'email') {
                            //سيبها.زي ما هيا 
                            header('location:?rt=Email/senduser');
                        } elseif ($method == 'call') {
                            $this->template->msg = 3;
                            $this->template->render("call/adduser");
                        } else {
                            $this->template->msg = 1;
                            $this->template->render("task/addnewuser");
                        }
                    } else {
                        $this->template->msg = -1;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("task/addnewuser");
                }
            }
        }
        $this->template->render("task/addnewuser");
    }

    function taskuserAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $this->template->task_method = $_POST['task_method'];
                $this->template->render('task/addnewuser');
            }
            $this->template->render('task/adduser');
        }
    }

    function taskAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $this->template->task_method = $_POST['task_method'];
                $this->template->render('task/addnew');
            }
            $this->template->render('task/add');
        }
    }

    function showoneAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['task_id']) && isset($_GET['m'])) {
                $task = $this->noti->task_id = intval($_GET['task_id']);
                if (!isset($_SESSION['user_id'])) {
                    $user = $this->noti->user_show_id = $_SESSION['acc_id'];
                } else {
                    $user = $this->noti->user_show_id = $_SESSION['user_id'];
                }
                $this->noti->acc_id = $_SESSION['acc_id'];
                $this->noti->act_id = 0;
                $this->noti->email_id = 0;
                $data = TaskModel::chechfound($task, $user);
                if (empty($data)) {
                    if ($this->noti->insert() >= 1) {
                        $this->template->render('task/showone');
                    } else {
                        $this->template->msg = -1;
                        $this->template->render('errors');
                    }
                }
                $this->template->render('task/showone');
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
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
            $m = TaskModel::get_count_task_by_method_and_acc_id($_GET['m'], $_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);
            $this->template->render('task/show');
        }
    }

    function deleteAction() {
        if (isset($_GET['task_id'])) {
            if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
                $this->template->render('admin/login');
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
                $this->template->msg = -1;
                $this->template->render('user/error');
            } else {
                $data = TaskModel::getAllDatabyid($_GET['task_id']);
                if (!empty($data)) {
                    $this->task->delete(intval($_GET['task_id']), $_SESSION['acc_id']);
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = 'تم حذف ' . $data[0]['task_name'] . ' من المهمات';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'task';
                        $this->act->insert();
                    }
                    header('location:?rt=Task/task');
                } else {
                    $this->template->msg = -1;
                    $this->template->render('errors');
                }
            }
        }
    }

}

?>