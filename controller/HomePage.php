<?php

class HomePage {

    private $template;
    private $valid;
    private $account;
    private $act;

    public function __construct() {
        $this->template = new Template();
        $this->account = new AccountModel();
        $this->act = new ActivityModel();
        $this->valid = new Validation();
    }

    function indexAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } elseif (!isset($_SESSION['acc_id'])) {
            header('location:index.php?rt=HomePage/login');
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

    function index2Action() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            $this->template->render('home2');
        }
    }

    function index3Action() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            $this->template->render('home3');
        }
    }

    function registerAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

                try {
                    $rules = array(
                        "acc_name" => "checkempty|checkstring",
                        "acc_email" => "checkempty|checkemail",
                        "acc_city" => "checkempty",
                        "role" => "checkempty",
                        "acc_phone" => "checkempty|checkphone",
                        "acc_password" => "checkempty|checkpassword"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }
                    $id = (time() + rand(-100000, 100000));
                    $this->account->acc_id = $id;
                    $email = $this->account->acc_email = $_POST['acc_email'];
                    $this->account->acc_password = md5($_POST['acc_password']);
                    $this->account->acc_name = trim($_POST['acc_name']);
                    $phone = $this->account->acc_phone = $_POST['acc_phone'];
                    $this->account->acc_city = trim($_POST['acc_city']);
                    $this->account->acc_start_date = date(DateTime::ATOM);
                    $role = $this->account->role = $_POST['role'];
                    if (empty($_FILES['acc_image']['name'])) {
                        $this->account->acc_image = 'avatar5.png';
                    } else {
                        $image = $_FILES['acc_image']['name'];
                        $image = time() . rand(0, 1000) . $image;
                        move_uploaded_file($_FILES['acc_image']['tmp_name'], Upload_FOLDER . DS . $image);
                        $this->account->acc_image = $image;
                    }
                    if (empty($this->account->checkemail($email))) {
                        if (empty($this->account->checkphone($phone))) {
                            if ($this->account->insertCompose() >= 1) {
                                $_SESSION['acc_id'] = (int) $id;
                                $_SESSION['role'] = $role;
                                header('location:index.php');
                            } else {
                                $this->template->msg = -1;
                            }
                        } else {
                            $this->template->msg = -4;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render('admin/register');
                }
            }

            $this->template->render('admin/register');
        } else {
            $this->template->render('home');
        }
    }

    function facebookAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            if (isset($_SESSION['facebook'])) {
                $dataaccount = AccountModel::checkemail($_SESSION['facebook']['email']);
                if (count($dataaccount) > 0) {
                    $_SESSION['acc_id'] = (int) $dataaccount[0]['acc_id'];
                    $_SESSION['role'] = $dataaccount[0]['role'];
                    header('location:index.php');
                } else {

                    $id = (time() + rand(-100000, 100000));
                    $this->account->acc_id = $id;
                    $email = $this->account->acc_email = $_SESSION['facebook']['email'];
                    $this->account->acc_password = md5('facebook');
                    $this->account->acc_name = $_SESSION['facebook']['fname'] . " " . $_SESSION['facebook']['lname'];
                    $phone = $this->account->acc_phone = '12345678901';
                    $this->account->acc_city = 'Enter your addrss';
                    $this->account->acc_start_date = date(DateTime::ATOM);
                    $role = $this->account->role = 'manager';
                    $this->account->acc_image = 'avatar5.png';
                    if (empty($this->account->checkemail($email))) {
                        if ($this->account->insertCompose() >= 1) {
                            $_SESSION['acc_id'] = (int) $id;
                            $_SESSION['role'] = $role;
                            header('location:index.php');
                        } else {
                            $this->template->msg = -1;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                }
            } else {
                header('location:index.php');
                // header('location:logout.php?logout');
            }
        } else {
            header('location:index.php?rt=HomePage/login');
        }
    }

    function googleAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            if (isset($_SESSION['google_data'])) {
                $dataaccount = AccountModel::checkemail($_SESSION['google_data']['email']);
                if (count($dataaccount) > 0) {
                    $_SESSION['acc_id'] = (int) $dataaccount[0]['acc_id'];
                    $_SESSION['role'] = $dataaccount[0]['role'];
                    header('location:index.php');
                } else {

                    $id = (time() + rand(-100000, 100000));
                    $this->account->acc_id = $id;
                    $email = $this->account->acc_email = $_SESSION['google_data']['email'];
                    $this->account->acc_password = md5('google');
                    $this->account->acc_name = $_SESSION['google_data']['name'];
                    $phone = $this->account->acc_phone = '12345678901';
                    $this->account->acc_city = 'Enter your addrss';
                    $this->account->acc_start_date = date(DateTime::ATOM);
                    $role = $this->account->role = 'manager';
                    $this->account->acc_image = 'avatar5.png';
                    if (empty($this->account->checkemail($email))) {
                        if ($this->account->insertCompose() >= 1) {
                            $_SESSION['acc_id'] = (int) $id;
                            $_SESSION['role'] = $role;
                            header('location:index.php');
                        } else {
                            $this->template->msg = -1;
                        }
                    } else {
                        $this->template->msg = -2;
                    }
                }
            } else {
                header('location:index.php');
                // header('location:logout.php?logout');
            }
        } else {
            header('location:index.php?rt=HomePage/login');
        }
    }

    function searchAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                if ($_SESSION['role'] == 'user') {

                    $this->template->datasearch = ContactModel::search('contact_name', trim($_POST['search_name']));
                    $this->template->render("contact/search");
                } elseif ($_SESSION['role'] != 'user') {
                    $contact = ContactModel::search('contact_name', trim($_POST['search_name']));
                    $user = UserModel::search('user_name', trim($_POST['search_name']));
                    $this->template->datacontact = $contact;
                    $this->template->datauser = $user;
                    $this->template->render("user/search");
                }
            }
            header('location:index.php');
        }
    }

    function loginAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
                $email = $_POST['email']; //from user
                $password = md5($_POST['password']); //from user
                $data = AccountModel::check($email, $password); //check in db
                $datauser = UserModel::check($email, $password); //check in db
                if (count($datauser) == 1) {
                    $role = $_SESSION['role'] = $datauser[0]['role']; //set session role
                    $_SESSION['acc_id'] = (int) $datauser[0]['acc_id']; //set session id 
                    $_SESSION['user_id'] = (int) $datauser[0]['user_id']; //set session id  
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'بتسجيل دخول  ' . $datauser[0]['user_name'] . 'قام ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'login';
                    if ($this->act->insertCompose() == 1) {
                        if (isset($_POST['check'])) {//set cooki checked
                            $cooki_value = $role;
                            $cooki_time = time() + 60 * 60 * 5;
                            setcookie('user_role', $cooki_value, $cooki_time);
                            setcookie('user_id', $_SESSION['user_id'], $cooki_time);
                            header('location:index.php');
                        } else {//cooki un checked
                            header('location:index.php');
                        }
                    } else {
                        header('location:index.php');
                    }
                } elseif (count($data) == 1) {
                    $role = $_SESSION['role'] = $data[0]['role']; //set session role
                    $_SESSION['acc_id'] = (int) $data[0]['acc_id']; //set session id 
                    if (isset($_POST['check'])) {//set cooki checked
                        $cooki_value = $role;
                        $cooki_time = time() + 60 * 60 * 5;
                        setcookie('user_role', $cooki_value, $cooki_time);
                        setcookie('acc_id', $_SESSION['acc_id'], $cooki_time);
                        header('location:index.php');
                    } else {//cooki un checked
                        header('location:index.php');
                    }
                }
            }
            $this->template->render('admin/login');
        } else {
            //echo $_SESSION['user_id'];
            header('location:index.php');
        }
    }

    function logoutAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/login');
        } else {
            if (isset($_SESSION['user_id'])) {
                $data = UserModel::getAllDatabyid($_SESSION['user_id']);
                $this->act->act_datetime = date(DateTime::ATOM);
                $this->act->act_details = 'بتسجيل  خروج    ' . $data[0]['user_name'] . ' قام ';
                $this->act->user_id = $_SESSION['user_id'];
                $this->act->acc_id = $_SESSION['acc_id'];
                $this->act->type = 'logout';
                $this->act->insert();
            }
            if (isset($_SESSION['google_data']['email'])) {
                header('location:logout.php?logout');
            }
            if (isset($_SESSION['facebook']['email'])) {
                header('location:logout3.php?logout');
            }
            if (isset($_COOKIE)) {
                $cooki_time = time() - 60 * 5;
                setcookie('user_role', $_SESSION['role'], $cooki_time);
                setcookie('acc_id', $_SESSION['acc_id'], $cooki_time);
                setcookie('user_id', $_SESSION['user_id'], $cooki_time);
            }

            session_unset();
            $this->template->render('admin/login');
//         header('location:index.php?rt=HomePage/login');
            // header("location:index.php");
        }
    }

    function errorsAction() {
        if (!isset($_SESSION['role'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->msg = -1;
            $this->template->render('errors');
        }
    }

}
