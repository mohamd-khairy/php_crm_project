<?php

class Email {

    private $template;
    private $email;
    private $act;
    private $noti;

    public function __construct() {
        $this->template = new Template();
        $this->email = new EmailModel();
        $this->act = new ActivityModel();
        $this->noti = new NotifyModel();
    }

    function indexAction() {//this cod should take to the page activity , report ....
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
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


    function sendajaxAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('email/sendajax');
        }
    }

    function complete_sendajaxAction() {
        if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
            if (!empty($_FILES['file']['name'])) {
                $attach = $_FILES['file']['name'];
                $attach = time() . rand(0, 1000) . $attach;
                move_uploaded_file($_FILES['file']['tmp_name'], Attach_FOLDER . DS . $attach);
                $_SESSION['email_attach'] = $attach;
            }
            if (!empty(strpos($_POST['contacts'], ','))) {
                $contact_id = explode(',', $_POST['contacts']);
            } else {
                $contact_id[0] = $_POST['contacts'];
            }
            $c = array();
            foreach ($contact_id as $con) {
                $c[] = ContactModel::getAllDatabyid($con)[0];
            }
            $_SESSION['contacts_data'] = $c;
            $_SESSION['email_content'] = $_POST['email_content'];
            header('location:mail.php');
        }
    }

    function backsendajaxAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (!empty($_SESSION['contacts_data'])) {
                if (isset($_GET['r']) && $_GET['r'] == 1) {
                    foreach ($_SESSION['contacts_data'] as $conn) {
                        $this->email->acc_id = $_SESSION['acc_id'];
                        $this->email->contact_id = $conn['contact_id'];

                        if (isset($_SESSION['email_attach'])) {
                            $this->email->email_attach = $_SESSION['email_attach'];
                        }
                        $this->email->email_content = $_SESSION['email_content'];
                        $this->email->email_date = date(DateTime::ATOM);
                        $this->email->email_email = $conn['contact_email'];
                        $this->email->user_id = 0;
                        $this->email->insert();
                    }
                    unset($_SESSION['email_content']);
                    unset($_SESSION['contacts_data']);
                    if (isset($_SESSION['email_attach'])) {
                        unset($_SESSION['email_attach']);
                    }
                    header('location:?rt=Contact/show&r=1');
                } else {
                    unset($_SESSION['email_content']);
                    unset($_SESSION['contacts_data']);
                    if (isset($_SESSION['email_attach'])) {
                        unlink(Attach_FOLDER . DS . $_SESSION['email_attach']);
                        unset($_SESSION['email_attach']);
                    }
                    header('location:?rt=Contact/show&r=-1');
                }
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

    function count_emailAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($_SESSION['role'] != 'user') {
                $data = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $data = EmailModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            echo count($data);
        }
    }

    function count_email_showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $i = 0;
            if ($_SESSION['role'] != 'user') {
                $data = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $data = EmailModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            foreach ($data as $email) {
                if (!isset($_SESSION['user_id'])) {
                    $emails = NotifyModel::getAllDatabyid_email($email['email_id'], $_SESSION['acc_id']);
                } else {
                    $emails = NotifyModel::getAllDatabyid_email($email['email_id'], $_SESSION['user_id']);
                } if (empty($emails)) {
                    $i++;
                }
            }
            echo $i;
        }
    }

    function emailnotyAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($_SESSION['role'] != 'user') {
                $data = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
            } else {
                $data = EmailModel::getAllData_by_contact_id_not_equal_null_fornotify($_SESSION['acc_id']);
            }
            foreach ($data as $email) {
                if (!isset($_SESSION['user_id'])) {
                    $emails = NotifyModel::getAllDatabyid_email($email['email_id'], $_SESSION['acc_id']);
                } else {
                    $emails = NotifyModel::getAllDatabyid_email($email['email_id'], $_SESSION['user_id']);
                }
                if (empty($emails)) {
                    echo ' <li><!-- start message -->
    <a href="?rt=Email/showone&id=' . $email['email_id'] . '">
        <div class="pull-left">
            <img src="' . HostName . DS . 'img/e.png' . '" class="img-circle" alt="User Image">
        </div>
        <h4>
            <small><i class="fa fa-clock-o"></i> ' . date('h:i D', $email['email_date']) . '</small>
        </h4>
        <p>' . $email['email_email'] . '</p>
            <h6>' . $email['email_content'] . '</h6>
    </a>
</li>';
                }
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
            $m = EmailModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);

            $this->template->render('email/show');
        }
    }

    function showoneAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } elseif (isset($_GET['id'])) {
            $email = $this->noti->email_id = intval($_GET['id']);
            if (!isset($_SESSION['user_id'])) {
                $user = $this->noti->user_show_id = $_SESSION['acc_id'];
            } else {
                $user = $this->noti->user_show_id = $_SESSION['user_id'];
            }
            $this->noti->acc_id = $_SESSION['acc_id'];
            $this->noti->act_id = 0;
            $this->noti->task_id = 0;
            $data = EmailModel::chechfound($email, $user);
            if (empty($data)) {
                if ($this->noti->insert() >= 1) {
                    $this->template->render('email/showone');
                } else {
                    $this->template->msg = -1;
                    $this->template->render('errors');
                }
            }
            $this->template->render('email/showone');
        } else {
            $this->template->msg = -1;
            $this->template->render('errors');
        }
    }

    function delete_allAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($_SESSION['role'] != 'user') {

                $image = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
                if ($this->email->delete_all($_SESSION['acc_id']) >= 1) {
                    if (!empty($image)) {
                        foreach ($image as $img) {
                            $pos = strpos('.', $img['email_attach']);
                            if (isset($img['email_attach']) && isset($pos)) {
                                unlink("attachment/" . $img['email_attach']);
                            }
                        }
                    }
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = 'نم حذ كل الايميلات';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'email';
                        $this->act->insert();
                    }
                    echo " <div class='alert alert-danger h4' role='alert'>..تم حذف الكل .. </div>";
                }
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

    function sendotherAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_GET['msg']) && $_GET['msg'] == -1) {
                $this->template->msg = -1;
                $this->template->render('email/sendother');
            } else {
                if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                    if (!empty($_POST['email']) && !empty($_POST['email_content'])) {
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['email_content'] = $_POST['email_content'];
                        if (!empty($_FILES['email_attach']['name'])) {
                            $attach = $_FILES['email_attach']['name'];
                            $attach = time() . rand(0, 1000) . $attach;
                            move_uploaded_file($_FILES['email_attach']['tmp_name'], Attach_FOLDER . DS . $attach);
                            $_SESSION['email_attach'] = $attach;
                        }
                        header('location:mail.php');
                    } else {
                        $this->template->msg = -1;
                        $this->template->render('errors');
                    }
                }
                if (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/sendother") {
//                    $this->template->msg = 1;
                }
                $this->template->render('email/sendother');
            }
        }
    }

    function backsendotherAction() {

        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $this->template->render('email/sendother');
            } else {
                $this->email->email_content = $_SESSION['email_content'];
                $email = $this->email->email_email = $_SESSION['email'];
                $this->email->email_date = date(DateTime::ATOM);
                $this->email->email_attach = $_SESSION['email_attach'];
                $this->email->contact_id = 0;
                $this->email->user_id = 0;
                $this->email->acc_id = $_SESSION['acc_id'];
                unset($_SESSION['email_content']);
                unset($_SESSION['email']);
                if (isset($_SESSION['email_attach'])) {
                    unset($_SESSION['email_attach']);
                }
                if ($this->email->insertCompose() == 1) {
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = $email . 'تم ارسال ايميل الي ';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'email';
                        $this->act->insert();
                    }
                    header('location:?rt=Email/sendother');
                } else {
                    $this->template->msg = -1;
                }
            }
            $this->template->render('email/sendother');
        }
    }

    function senduserAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } elseif (isset($_GET['msg']) && $_GET['msg'] == -1) {
            $this->template->msg = -1;
            $this->template->render('email/adduser');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                if (!empty($_POST['email']) && !empty($_POST['email_content'])) {
                    $email = $_POST['email'];
                    $id = UserModel::checkemail($email);
                    if (!empty($id)) {
                        $title = $_POST['email_content'];
                        $_SESSION['contact_id_email'] = $id[0]['user_id'];
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['email_content'] = $title;
                        if (!empty($_FILES['email_attach']['name'])) {
                            $attach = $_FILES['email_attach']['name'];
                            $attach = time() . rand(0, 1000) . $attach;
                            move_uploaded_file($_FILES['email_attach']['tmp_name'], Attach_FOLDER . DS . $attach);
                            $_SESSION['email_attach'] = $attach;
                        }
                        header('location:mail.php');
                    } else {
                        $this->template->msg = -1;
                        $this->template->render('email/adduser');
                    }
                } else {
                    $this->template->msg = -1;
                    $this->template->render('errors');
                }
            }
            if (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/senduser") {
                $this->template->msg = 1;
            } elseif (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Task/taskuser") {
                $this->template->msg = 3;
            }
            $this->template->render('email/adduser');
        }
    }

    function backsenduserAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $this->template->render('email/adduser');
            } else {
                $this->email->contact_id = 0;
                $id = $this->email->user_id = $_SESSION['contact_id_email'];
                $this->email->email_content = $_SESSION['email_content'];
                $this->email->email_date = date(DateTime::ATOM);
                $this->email->acc_id = $_SESSION['acc_id'];
                $email = $this->email->email_email = $_SESSION['email'];
                $this->email->email_attach = $_SESSION['email_attach'];
                unset($_SESSION['email_content']);
                unset($_SESSION['email']);
                unset($_SESSION['contact_id_email']);
                if (isset($_SESSION['email_attach'])) {
                    unset($_SESSION['email_attach']);
                }
                if ($this->email->insert() >= 1) {
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = $email . 'تم ارسال ايميل الي';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'email';
                        $this->act->insert();
                    }
                    header('location:?rt=Email/senduser');
                } else {
                    $this->template->msg = -1;
                    $this->template->render('email/adduser');
                }
            }
            $this->template->render('email/adduser');
        }
    }

    function sendAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } elseif (isset($_GET['msg']) && $_GET['msg'] == -1) {
            $this->template->msg = -1;
            $this->template->render('email/add');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                if (!empty($_POST['email']) && !empty($_POST['email_content'])) {

                    $email = $_POST['email'];
                    $id = ContactModel::checkemail($email);
                    if (!empty($id)) {
                        $title = $_POST['email_content'];
                        $_SESSION['contact_id_email'] = $id[0]['contact_id'];
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['email_content'] = $title;
                        if (!empty($_FILES['email_attach']['name'])) {
                            $attach = $_FILES['email_attach']['name'];
                            $attach = time() . rand(0, 1000) . $attach;
                            move_uploaded_file($_FILES['email_attach']['tmp_name'], Attach_FOLDER . DS . $attach);
                            $_SESSION['email_attach'] = $attach;
                        }
                        header('location:mail.php');
                    } else {
                        $this->template->msg = -1;
                        $this->template->render('email/add');
                    }
                } else {
                    $this->template->msg = -1;
                    $this->template->render('errors');
                }
            }
            if (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/send") {
                $this->template->msg = 1;
            }
            $this->template->render('email/add');
        }
    }

    function backsendAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (!isset($_SERVER['HTTP_REFERER'])) {
                $this->template->render('email/add');
            } else {
                $this->email->user_id = 0;
                $id = $this->email->contact_id = $_SESSION['contact_id_email'];
                $this->email->email_content = $_SESSION['email_content'];
                $this->email->email_date = date(DateTime::ATOM);
                $this->email->acc_id = $_SESSION['acc_id'];
                $email = $this->email->email_email = $_SESSION['email'];
                $this->email->email_attach = $_SESSION['email_attach'];
                unset($_SESSION['email_content']);
                unset($_SESSION['email']);
                unset($_SESSION['contact_id_email']);
                if (isset($_SESSION['email_attach'])) {
                    unset($_SESSION['email_attach']);
                }
                if ($this->email->insert() >= 1) {
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = $email . ' تم ارسال ايميل الي';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->role = $_SESSION['role'];
                        $this->act->type = 'email';
                        $this->act->insert();
                    }
                    header('location:?rt=Email/send');
                } else {
                    $this->template->msg = -1;
                    $this->template->render('email/add');
                }
            }
            $this->template->render('email/add');
        }
    }

    function deleteAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } elseif (isset($_GET['id']) && intval($_GET['id'])) {
            $image = $this->email->get_by_id($_GET['id']);
            $this->email->delete(intval($_GET['id']), $_SESSION['acc_id']);
            if (!empty($image) && (isset($image->email_attach))) {
                unlink(AttAttach_FOLDER . DS . $image->email_attach);
            }
            if (isset($_SESSION['user_id'])) {
                $data = EmailModel::getAllDatabyid($_GET['id']);
                $this->act->act_datetime = date(DateTime::ATOM);
                $this->act->act_details = ' من الايميلات' . $data[0]['email_email'] . 'تم حذف ';
                $this->act->user_id = $_SESSION['user_id'];
                $this->act->acc_id = $_SESSION['acc_id'];
                $this->act->type = 'email';
                $this->act->insert();
            }
            echo " <div class='alert alert-danger h4' role='alert'>..تم الحذف.. </div>";
        } else {
            $this->template->msg = -1;
            $this->template->render('errors');
        }
    }

}

?>