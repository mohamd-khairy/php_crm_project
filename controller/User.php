<?php

class User {

    private $template;
    private $user;
    private $valid;
    private $act;
    private $acc;
    private $deal;
    private $task;
    private $call;
    private $email;
    private $chat;
    private $msg;

    public function __construct() {
        $this->template = new Template();
        $this->user = new UserModel();
        $this->act = new ActivityModel();
        $this->valid = new Validation();
        $this->acc = new AccountModel();
        $this->deal = new DealModel();
        $this->task = new TaskModel();
        $this->call = new CallModel();
        $this->email = new EmailModel();
        $this->chat = new ChatModel();
        $this->msg = new MsgModel();
    }

    function indexAction() {//this cod should take to the page activity , report ....
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
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

    function profileAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                try {
                    $rules = array(
                        "user_name" => "checkempty|checkstring",
                        "user_email" => "checkempty|checkemail",
                        "user_address" => "checkempty",
                        "user_phone" => "checkempty|checkphone",
                        "user_password" => "checkempty|checkpassword",
                        "company_id" => "checkempty",
                        "role" => "checkempty",
                        "user_job" => "checkempty",
                        "other" => "checktext"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }
                    $image = $this->user->get_by_id((int) $_POST['user_id']);
                    $id = $this->user->user_id = $_POST['user_id'];
                    $name = $this->user->user_name = trim($_POST['user_name']);
                    if (!empty($_FILES['user_image']['name'])) {
                        $user_image = $_FILES['user_image']['name'];
                        $user_image = time() . rand(0, 1000) . $user_image;
                        move_uploaded_file($_FILES['user_image']['tmp_name'], Upload_FOLDER . DS . $user_image);
                        $this->user->user_image = $user_image;
                        if (!empty($image) && isset($image->user_image)) {
                            if ($image->user_image != 'avatar5.png') {
                                unlink("img/" . $image->user_image);
                            }
                        }
                    } else {
                        $this->user->user_image = $image->user_image;
                    }
                    if (strlen($_POST['user_password']) == 32 && ($_POST['user_password'] == $image->user_password)) {
                        $this->user->user_password = $image->user_password;
                    } elseif (strlen($_POST['user_password']) != 32 && ($_POST['user_password'] != $image->user_password )) {
                        $this->user->user_password = md5($_POST['user_password']);
                    }
                    $this->user->user_address = $_POST['user_address'];
                    $this->user->user_phone = $_POST['user_phone'];
                    $this->user->user_job = $_POST['user_job'];
                    $this->user->company_id = $_POST['company_id'];
                    $this->user->role = $_POST['role'];
                    $this->user->user_other = $_POST['user_other'];
                    $this->user->user_date = $_POST['user_date'];
                    $this->user->acc_id = $image->acc_id;
                    $email = $this->user->user_email = $_POST['user_email'];
                    $check = UserModel::checkemail($email);
                    if (empty($check) || $email == $image->user_email) {
                        if ($this->user->update($id) >= 1) {
                            if (isset($_SESSION['user_id'])) {
                                $this->act->act_datetime = date(DateTime::ATOM);
                                $this->act->act_details = 'تم تعديل بيانات ' . $name;
                                $this->act->user_id = $_SESSION['user_id'];
                                $this->act->acc_id = $_SESSION['acc_id'];
                                $this->act->type = 'user';
                                $this->act->insert();
                            }
                            $this->template->msg = 1;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("user/profile");
                }
            }

            if ((isset($_GET['user_id']) && intval($_GET['user_id']))) {

                if ($_SESSION['role'] == 'user' && (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $_GET['user_id'] )) {
                    $this->template->msg = -1;
                    $this->template->render('user/error');
                } else {
                    $this->template->render('user/profile');
                }
            } elseif ((isset($_GET['acc_id']) && intval($_GET['acc_id']))) {
                $this->template->render('user/acc_profile');
            } else {
                $this->template->msg = -1;
                $this->template->render('user/error');
            }
        }
    }

    function acc_profileAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                try {
                    $rules = array(
                        "acc_name" => "checkempty|checkstring",
                        "acc_email" => "checkempty|checkemail",
                        "acc_start_date" => "checkempty",
                        "acc_phone" => "checkempty|checkphone",
                        "acc_password" => "checkempty|checkpassword",
                        "acc_city" => "checkempty",
                        "role" => "checkempty"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
//$this->template->msg = 1;
                    }
                    $image = $this->acc->get_by_id($_POST['acc_id']);
                    $id = $this->acc->acc_id = $_POST['acc_id'];
                    $name = $this->acc->acc_name = $_POST['acc_name'];
                    if (!empty($_FILES['acc_image']['name'])) {
                        $user_image = $_FILES['acc_image']['name'];
                        $user_image = time() . rand(0, 1000) . $user_image;
                        move_uploaded_file($_FILES['acc_image']['tmp_name'], Upload_FOLDER . DS . $user_image);
                        $this->acc->acc_image = $user_image;
                        if (!empty($image) && isset($image->acc_image)) {
                            if ($image->acc_image != 'avatar5.png') {
                                unlink("img/" . $image->acc_image);
                            }
                        }
                    } else {
                        $this->acc->acc_image = $image->acc_image;
                    }
                    if (strlen($_POST['acc_password']) == 32 && ($_POST['acc_password'] == $image->acc_password)) {
                        $this->acc->acc_password = $image->acc_password;
                    } elseif (strlen($_POST['acc_password']) != 32 && ($_POST['acc_password'] != $image->acc_password )) {
                        $this->acc->acc_password = md5($_POST['acc_password']);
                    }
                    $this->acc->acc_city = $_POST['acc_city'];
                    $this->acc->acc_phone = $_POST['acc_phone'];
                    $this->acc->acc_start_date = $_POST['acc_start_date'];
                    $this->acc->role = $_POST['role'];
                    $email = $this->acc->acc_email = $_POST['acc_email'];
                    $check = AccountModel::checkemail($email);
                    if (empty($check) || $email == $image->acc_email) {
                        if ($this->acc->update($id) >= 1) {
                            $this->template->msg = 1;
                        } else {
                            $this->template->msg = -1;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("user/acc_profile");
                }
            }

            if ((isset($_GET['acc_id']) && intval($_GET['acc_id']))) {
                if (($_SESSION['role'] == 'user' || $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'manager') &&
                        (isset($_SESSION['acc_id']) && $_SESSION['acc_id'] != $_GET['acc_id'] )) {
                    $this->template->msg = -1;
                    $this->template->render('user/error');
                } else {
                    $this->template->render('user/acc_profile');
                }
            } else {
                $this->template->msg = -1;
                $this->template->render('user/error');
            }
        }
    }

    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            $this->template->msg = -1;
            $this->template->render('user/error');
        } else {
            $this->template->render('user/show');
        }
    }

    function showallAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            $this->template->msg = -1;
            $this->template->render('user/error');
        } else {
            if (isset($_GET['pg']) && intval($_GET['pg'])) {
                $current = $_GET['pg'];
            } else {
                $current = 0;
            }
            $this->template->offset = $current;
            $m = UserModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);

            $this->template->render('user/all');
        }
    }

    function showalluserAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            $users = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);
            if (isset($_SESSION['user_id'])) {
                $acc = AccountModel::getAllDatabyid(UserModel::getAllDatabyid($_SESSION['user_id'])[0]['acc_id'])[0];
                foreach ($users as $user) {
                    $chat = ChatModel::check($acc['acc_id'], $user['user_id']);
                    if (!empty($chat)) {
                        $msg = MsgModel::getAllDataby_chat_id_DESC($chat[0]['chat_id'])[0]['msg_content'];
                    } else {
                        $chat2 = ChatModel::check($user['user_id'], $acc['acc_id']);
                        if (!empty($chat2)) {
                            $msg = MsgModel::getAllDataby_chat_id_DESC($chat2[0]['chat_id'])[0]['msg_content'];
                        } else {
                            $msg = "no msg";
                        }
                    }
                }


                echo '<li>';

                echo '<a tybe="button" onclick="toggle(' . $acc['acc_id'] . ');">
                                    <img class="contacts-list-img" src="' . HostName . DS . 'img' . DS . $acc['acc_image'] . '" alt="User Image">
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                           ' . $acc['acc_name'] . '
                                            <small class="contacts-list-date pull-right">' . $acc['acc_start_date'] . '</small>
                                        </span>
                                        <span class="contacts-list-msg">' . $msg . '...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>';
            }
            echo '</li>';
            foreach ($users as $user) {
                if ($user['user_id'] != $_SESSION['user_id'] && $user['user_id'] != $_SESSION['acc_id']) {
                    $chat = ChatModel::check($_SESSION['acc_id'], $user['user_id']);
                    if (!empty($chat)) {
                        $msg = MsgModel::getAllDataby_chat_id_DESC($chat[0]['chat_id'])[0]['msg_content'];
                    } else {
                        $chat2 = ChatModel::check($user['user_id'], $_SESSION['acc_id']);
                        if (!empty($chat2)) {
                            $msg = MsgModel::getAllDataby_chat_id_DESC($chat2[0]['chat_id'])[0]['msg_content'];
                        } else {
                            $msg = "no msg";
                        }
                    }
                    echo '<li>';

                    echo '<a tybe="button" onclick="toggle(' . $user['user_id'] . ');">
                                    <img class="contacts-list-img" src="' . HostName . DS . 'img' . DS . $user['user_image'] . '" alt="User Image">
                                    <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                           ' . $user['user_name'] . '
                                            <small class="contacts-list-date pull-right">' . $user['user_date'] . '</small>
                                        </span>
                                        <span class="contacts-list-msg">' . substr($msg, 0, 25) . '...</span>
                                    </div>
                                    <!-- /.contacts-list-info -->
                                </a>
                            </li>';
                }
            }
        }
    }

    function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
            $this->template->msg = -1;
            $this->template->render('user/error');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                try {
                    $rules = array(
                        "user_name" => "checkempty|checktext",
                        "user_email" => "checkempty|checkemail",
                        "user_address" => "checkempty",
                        "user_phone" => "checkempty|checkphone",
                        "user_password" => "checkempty|checkpassword",
                        "company_id" => "checkempty",
                        "role" => "checkempty",
                        "user_job" => "checkempty|checktext",
                        "user_other" => "checktext"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }
                    $name = $this->user->user_name = $_POST['user_name'];
                    $email = $this->user->user_email = $_POST['user_email'];
                    $this->user->user_address = $_POST['user_address'];
                    $this->user->user_phone = $_POST['user_phone'];
                    $this->user->company_id = $_POST['company_id'];
                    $this->user->user_password = md5($_POST['user_password']);
                    if (!empty($_FILES['user_image']['name'])) {
                        $user_image = $_FILES['user_image']['name'];
                        $user_image = time() . rand(0, 1000) . $user_image;
                        move_uploaded_file($_FILES['user_image']['tmp_name'], Upload_FOLDER . DS . $user_image);
                        $this->user->user_image = $user_image;
                    } else {
                        $this->user->user_image = 'avatar5.png';
                    }
                    $this->user->user_other = $_POST['user_other'];
                    $this->user->user_date = date(DateTime::ATOM);
                    $this->user->role = $_POST['role'];
                    $this->user->user_job = $_POST['user_job'];
                    $this->user->acc_id = $_SESSION['acc_id'];
                    $e = UserModel::checkemail($email);
                    if (empty($e)) {
                        if ($this->user->insert() >= 1) {
                            if ($_SESSION['role'] != 'manager') {
                                $this->act->act_datetime = date(DateTime::ATOM);
                                $this->act->act_details = $name . ' تم اضافه موظف جديد';
                                $this->act->user_id = $_SESSION['user_id'];
                                $this->act->type = 'user';
                                $data = UserModel::getAllDatabyid($_SESSION['user_id']);
                                if (!empty($data)) {
                                    $acc = $data[0]['acc_id'];
                                }
                                $this->act->acc_id = $acc;
                                if ($this->act->insert() >= 1) {
                                    $this->template->msg = 1;
                                } else {
                                    $this->template->msg = -1;
                                }
                            } else {
                                $this->template->msg = 1;
                            }
                        } else {
                            $this->template->msg = -1;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("user/add");
                }
            }
            $this->template->render("user/add");
        }
    }

    function deleteAction() {
        if (isset($_GET['user_id']) && intval($_GET['user_id'])) {
            if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
                $this->template->render('admin/login');
            } elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'user') {
                $this->template->msg = -1;
                $this->template->render('user/error');
            } else {
                $data = UserModel::getAllDatabyid($_GET['user_id']);
                $deal = DealModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $act = ActivityModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $task = TaskModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $call = CallModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $email = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $chat = ChatModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $image = $this->user->get_by_id($_GET['user_id']);
                $this->user->delete($_GET['user_id'], $_SESSION['acc_id']);
                if (!empty($image) && isset($image->user_image)) {
                    if ($image->user_image != 'avatar5.png') {
                        unlink("img/" . $image->user_image);
                    }
                }
                foreach ($chat as $ch) {
                    if ($ch['speak1_id'] != $_GET['user_id']) {
                        if ($ch['speak2_id'] == $_GET['user_id']) {
                            $this->chat->delete($ch['chat_id'], $_SESSION['acc_id']);
                            $this->msg->deletemsg($ch['chat_id']);
                        }
                    } else {
                        $this->chat->delete($ch['chat_id'], $_SESSION['acc_id']);
                        $this->msg->deletemsg($ch['chat_id']);
                    }
                }
                foreach ($deal as $d) {
                    if ($d['user_id'] == $_GET['user_id']) {
                        $this->deal->delete($d['deal_id'], $_SESSION['acc_id']);
                    }
                }

                foreach ($act as $a) {
                    if ($a['user_id'] == $_GET['user_id']) {
                        $this->act->delete($a['act_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($task as $t) {
                    if ($t['user_id'] == $_GET['user_id']) {
                        $this->task->delete($t['task_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($call as $c) {
                    if ($c['user_id'] == $_GET['user_id']) {
                        $this->call->delete($c['call_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($email as $e) {
                    if ($e['user_id'] == $_GET['user_id']) {
                        $this->email->delete($e['email_id'], $_SESSION['acc_id']);
                    }
                }
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'تم حذف ' . $data[0]['user_name'] . '  من الموظفين';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'user';
                    if ($this->act->insert() >= 1) {
                        header("location:index.php?rt=User/showall");
                    } else {
                        $this->template->msg = -1;
                    }
                }
                header("location:index.php?rt=User/showall");
            }
        }
    }

}

?>