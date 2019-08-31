<?php

class Call {

    private $template;
    private $call;
    private $act;
    private $valid;

    public function __construct() {
        $this->template = new Template();
        $this->call = new CallModel();
        $this->act = new ActivityModel();
        $this->valid = new Validation();
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

    function adduserajaxAction() {
        try {
            $rules = array(
                "call_title" => "checkempty|checktext",
                "user_id" => "checkempty"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $this->call->contact_id = 0;
            $id = $this->call->user_id = $_GET['user_id'];
            $number = UserModel::getAllDatabyid($id);
            $this->call->call_number = $number[0]['user_phone'];
            $call = $this->call->call_title = $_GET['call_title'];
            $this->call->call_date = date(DateTime::ATOM);
            $this->call->acc_id = $_SESSION['acc_id'];
            if ($this->call->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'تمت اضافه  ' . $call . ' الي المكالمات';
                    $this->act->type = 'call';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->insert();
                }
                echo ' <div class="alert alert-success h5" role="alert">تم الاضافه بنجاح...</div>';
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo "<div class='alert alert-danger h4' role='alert'><strong>خطأ!</strong>$m </div>";
        }
    }

    function adduserAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('call/adduser');
        }
    }

    function addotherajaxAction() {
        try {
            $rules = array(
                "call_title" => "checkempty|checktext",
                "call_number" => "checkempty|checkphone"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                // $this->template->msg = 1;
            }
            $number = $this->call->call_number = $_GET['call_number'];
            $id = ContactModel::getAllDatabynumber($number);
            $iduser = UserModel::getAllDatabynumber($number);
            if (!empty($id) && !empty($iduser)) {
                $this->call->user_id = 0;
                $this->call->contact_id = 0;
            } elseif (!empty($id)) {
                $this->call->contact_id = $id[0]['contact_id'];
                $this->call->user_id = 0;
            } elseif (!empty($iduser)) {
                $this->call->user_id = $iduser[0]['user_id'];
                $this->call->contact_id = 0;
            } else {
                $this->call->user_id = 0;
                $this->call->contact_id = 0;
            }
            $call = $this->call->call_title = $_GET['call_title'];
            $this->call->call_date = date(DateTime::ATOM);
            $this->call->acc_id = $_SESSION['acc_id'];
            if ($this->call->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'تمت اضافه ' . $call . ' الي المكالمات';
                    $this->act->type = 'call';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->insert(); 
                }
                echo '<div class="alert alert-success h5" role="alert">تم الاضافه بنجاح...</div></div>';
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo " <div class='alert alert-danger h4' role='alert'>..$m.. </div>";
        }
    }

    function addotherAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('call/addother');
        }
    }

    function addajaxAction() {
        try {
            $rules = array(
                "call_title" => "checkempty|checktext",
                "contact_id" => "checkempty"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $id = $this->call->contact_id = $_GET['contact_id'];
            $number = ContactModel::getAllDatabyid($id);
            $this->call->call_number = $number[0]['contact_phone'];
            $call = $this->call->call_title = $_GET['call_title'];
            $this->call->call_date = date(DateTime::ATOM);
            $this->call->acc_id = $_SESSION['acc_id'];
            $this->call->user_id = 0;
            if ($this->call->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'تمت اضافه  ' . $call . ' الي المكالمات';
                    $this->act->type = 'call';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->insert();
                }
                echo '<div class="alert alert-success h5" role="alert">تم الاضافه بنجاح...</div></div>';
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo " <div class='alert alert-danger h4' role='alert'>..$m.. </div>";
        }
    }

    function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $this->template->render('call/add');
        }
    }

    function deleteAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if ($this->call->delete(intval($_GET['call_id']), $_SESSION['acc_id'])) {
                if (isset($_SESSION['user_id'])) {
                    $data = CallModel::getAllDatabyid($_GET['call_id']);
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = ' من المكالمات' . $data[0]['call_title'] . ' نم حذف';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'call';
                    $this->act->insert();
                }
                echo " <div class='alert alert-danger h4' role='alert'>..تم الحذف.. </div>";
            } else {
                echo " <div class='alert alert-danger h4' role='alert'>..لم يتم الحذف .. </div>";
            }
        }
    }

    function delete_allAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->call->delete_all($_SESSION['acc_id']);
            if (isset($_SESSION['user_id'])) {
                $this->act->act_datetime = date(DateTime::ATOM);
                $this->act->act_details = 'تم حذف كل المكالمات';
                $this->act->user_id = $_SESSION['user_id'];
                $this->act->type = 'call';
                $this->act->acc_id = $_SESSION['acc_id'];
                $this->act->insert(); 
            }
            echo " <div class='alert alert-danger h4' role='alert'>..تم حذف الكل .. </div>";
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
            $m = CallModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);
            $this->template->render('call/show');
        }
    }

}

?>