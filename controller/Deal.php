<?php

class Deal {

    private $template;
    private $deal;
    private $act;
    private $valid;

    public function __construct() {
        $this->template = new Template();
        $this->deal = new DealModel();
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

    function count_dealAction(){
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
             $data= DealModel::getAllData_by_acc_id($_SESSION['acc_id']);
              echo count($data);  
        }
    }
    function exelAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_SESSION['user_id'])) {
                $this->act->act_datetime = date(DateTime::ATOM);
                $this->act->act_details = 'تم اخذ ملف اكسل من الصفقات';
                $this->act->user_id = $_SESSION['user_id'];
                $this->act->acc_id = $_SESSION['acc_id'];
                $this->act->type = 'deal';
                if ($this->act->insertCompose() == 1) {
                    $this->template->render('deal/exel');
                } else {
                    $this->template->msg = -1;
                }
            }
            $this->template->render('deal/exel');
        }
    }

    function profileajaxAction() {
        try {
            $rules = array(
                "deal_name" => "checkempty|checktext",
                "deal_value" => "checkempty|checkint",
                "deal_start_date" => "checkempty|checkdate",
                "deal_end_date" => "checkempty|checkdate",
                "other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $id_con = $this->deal->contact_id =  $_GET['contact_id'];
            $id_user = $this->deal->user_id =  $_GET['user_id'];
            if ($id_con == 0 && $id_user == 0) {
                $this->deal->deal_user = trim($_GET['deal_user']);
            } elseif ($id_con != 0 && $id_user == 0) {
                $name_con = ContactModel::getAllDatabyid($id_con);
                $this->deal->deal_user = trim($name_con[0]['contact_name']);
            } elseif ($id_con == 0 && $id_user != 0) {
                $name_user = UserModel::getAllDatabyid($id_user);
                $this->deal->deal_user = trim($name_user[0]['user_name']);
            }
            $id = $this->deal->deal_id =  $_GET['deal_id'];
            $this->deal->deal_start_date = $_GET['deal_start_date'];
            $this->deal->deal_end_date = $_GET['deal_end_date'];
            $this->deal->deal_value = $_GET['deal_value'];
            $name = $this->deal->deal_name = $_GET['deal_name'];
            $this->deal->acc_id =  $_SESSION['acc_id'];
            $this->deal->other = $_GET['other'];
            if ($this->deal->update($id) >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = ' بيانات الصفقه' . $name . 'تم تعديل ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->type = 'deal';
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->insert(); 
                }
                echo ' <div class="alert alert-success h5" role="alert">تم التعديل بنجاح...</div>';
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم التعديل..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo "<div class='alert alert-danger h4' role='alert'><strong>خطأ!</strong>$m </div>";
        }
    }

    function profileAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('deal/profile');
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
            $m = DealModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);

            $this->template->render('deal/show');
        }
    }

    function addajaxAction() {
        try {
            $rules = array(
                "deal_name" => "checkempty|checktext",
                "deal_value" => "checkempty|checkint",
                "deal_start_date" => "checkempty|checkdate",
                "deal_end_date" => "checkempty|checkdate",
                "other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }

            $id = $this->deal->contact_id = $_GET['contact_id'];
            if ($_GET['contact_id'] != 0) {
                $data = ContactModel::getAllDatabyid($id);
                $this->deal->deal_user = trim($data[0]['contact_name']);
            } else {
                $this->deal->deal_user = 0;
            }
            $this->deal->user_id = 0;
            $this->deal->deal_start_date = $_GET['deal_start_date'];
            $this->deal->deal_end_date = $_GET['deal_end_date'];
            $this->deal->deal_value = $_GET['deal_value'];
            $name = $this->deal->deal_name = $_GET['deal_name'];
            $this->deal->other = $_GET['other'];
            $this->deal->acc_id = $_SESSION['acc_id'];
            if ($this->deal->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = $name . 'تم اضافه صفقه جديده';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'deal';
                    $this->act->insertCompose(); 
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

    function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('deal/add');
        }
    }

    function adduserajaxAction() {
        try {
            $rules = array(
                "deal_name" => "checkempty|checktext",
                "deal_value" => "checkempty|checkint",
                "deal_start_date" => "checkempty|checkdate",
                "deal_end_date" => "checkempty|checkdate",
                "other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $this->deal->contact_id = 0;
            $data = UserModel::getAllDatabyid(intval($_GET['user_id']));
            if (!empty($data)) {
                $this->deal->deal_user = trim($data[0]['user_name']);
            } else {
                $this->deal->deal_user = 0;
            }
            $this->deal->user_id = $_GET['user_id'];
            $this->deal->deal_start_date = $_GET['deal_start_date'];
            $this->deal->deal_end_date = $_GET['deal_end_date'];
            $this->deal->deal_value = $_GET['deal_value'];
            $name = $this->deal->deal_name = $_GET['deal_name'];
            $this->deal->other = $_GET['other'];
            $this->deal->acc_id = $_SESSION['acc_id'];
            if ($this->deal->insertCompose() == 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = $name . 'تم اضافه صفقه جديده';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'deal';
                    $this->act->insertCompose(); 
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
            $this->template->render('deal/adduser');
        }
    }

    function addotherajaxAction() {
        try {
            $rules = array(
                "deal_user" => "checkempty|checktext",
                "deal_value" => "checkempty|checkint",
                "deal_start_date" => "checkempty|checkdate",
                "deal_end_date" => "checkempty|checkdate",
                "other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $this->deal->contact_id = 0;
            $this->deal->deal_user = trim($_GET['deal_user']);
            $this->deal->user_id = 0;
            $this->deal->deal_start_date = $_GET['deal_start_date'];
            $this->deal->deal_end_date = $_GET['deal_end_date'];
            $this->deal->deal_value = $_GET['deal_value'];
            $name = $this->deal->deal_name = $_GET['deal_name'];
            $this->deal->other = $_GET['other'];
            $this->deal->acc_id = $_SESSION['acc_id'];
            if ($this->deal->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = $name . 'تم اضافه صفقه جديده ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->role = $_SESSION['role'];
                    $this->act->type = 'deal';
                    $this->act->insertCompose(); 
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

    function addotherAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('deal/addother');
        }
    }

    function deleteAction() {
        if (isset($_GET['deal_id']) && intval($_GET['deal_id'])) {
            $data = DealModel::getAllDatabyid($_GET['deal_id']);
            if ($this->deal->delete(intval($_GET['deal_id']), $_SESSION['acc_id'])) {
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = ' من الصفقات' . $data[0]['deal_name'] . 'تم حذف  ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'deal';
                    $this->act->insert(); 
                }
                echo " <div class='alert alert-danger h4' role='alert'>..تم الحذف.. </div>";
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        } else {
            $this->template->msg = -1;
            $this->template->render('errors');
        }
    }

}

?>