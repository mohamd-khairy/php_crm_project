<?php

class Company {

    private $template;
    private $company;
    private $act;
    private $con;
    private $user;
    private $valid;

    public function __construct() {
        $this->template = new Template();
        $this->company = new CompanyModel();
        $this->act = new ActivityModel();
        $this->con = new ContactModel();
        $this->user = new UserModel();
        $this->valid = new Validation();
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

    function count_companyAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $data = CompanyModel::getAllData_by_acc_id($_SESSION['acc_id']);
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
            $m = CompanyModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);
            $this->template->render('company/show');
        }
    }

   function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

                try {
                    $rules = array(
                        "company_name" => "checkempty|checktext",
                        "company_address" => "checkempty",
                        "company_phone" => "checkempty|checkphone",
                        "company_url" => "checkempty|checkurl"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }
                    if (!empty($_FILES['company_image']['name'])) {
                        $image = $_FILES['company_image']['name'];
                        $image = time() . rand(0, 1000) . $image;
                        move_uploaded_file($_FILES['company_image']['tmp_name'], Upload_FOLDER . DS . $image);
                        $this->company->company_image = $image;
                    } else {
                        $this->company->company_image = "company.png";
                    }
                    $this->company->company_name = trim(strtoupper($_POST['company_name']));
                    $this->company->company_date = date(DateTime::ATOM);
                    $this->company->company_address = $_POST['company_address'];
                    $this->company->company_phone = $_POST['company_phone'];
                    $this->company->company_url = trim($_POST['company_url']);
                    $this->company->acc_id = (int) $_SESSION['acc_id'];
                    if ($this->company->insertCompose() == 1) {
                        if (isset($_SESSION['user_id'])) {
                            $this->act->act_datetime = date(DateTime::ATOM);
                            $this->act->act_details = $name . 'تم انشاء شركه جديد';
                            $this->act->user_id = (int) $_SESSION['user_id'];
                            $this->act->acc_id = (int) $_SESSION['acc_id'];
                            $this->act->type = 'company';
                            if ($this->act->insertCompose() == 1) {
                                $this->template->msg = 1;
                            } else {
                                $this->template->msg = -1;
                            }
                        }
                        $this->template->msg = 1;
                    } else {
                        $this->template->msg = -1;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("company/add");
                }
            }
            $this->template->render('company/add');
        }
    }

  
   
    function deleteAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/logout');
        } else {
            if (isset($_GET['company_id']) && intval($_GET['company_id'])) {
                $data = CompanyModel::getAllDatabyid((int) $_GET['company_id']);
                $contact = ContactModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $user = UserModel::getAllData_by_acc_id($_SESSION['acc_id']);

                $image = $this->company->get_by_id((int) $_GET['company_id']);
                $this->company->delete(intval($_GET['company_id']), $_SESSION['acc_id']);
                if (!empty($image) && isset($image->company_image)) {
                    if ($image->company_image != 'company.png') {
                        unlink("img/" . $image->company_image);
                    }
                }
                foreach ($contact as $c) {
                    if ($c['company_id'] == $data[0]['company_id']) {
                        $this->con->delete($c['contact_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($user as $u) {
                    if ($u['company_id'] == $data[0]['company_id']) {
                        $this->user->delete($u['user_id'], $_SESSION['acc_id']);
                    }
                }
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = ' من الشركات' . $data[0]['company_name'] . 'تم حذف ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'company';
                    if ($this->act->insert() >= 1) {
                        header('location:index.php?rt=Company/show');
                    } else {
                        $this->template->msg = -1;
                    }
                }
                header('location:index.php?rt=Company/show');
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

    function profileAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/logout');
        } else {
            if (strtolower($_SERVER['REQUEST_METHOD']) == 'post') {

                try {
                    $rules = array(
                        "company_name" => "checkempty|checktext",
                        "company_address" => "checkempty",
                        "company_phone" => "checkempty|checkphone",
                        "company_url" => "checkempty"
                    );
                    if (!$this->valid->validate($_POST, $rules)) {
                        $this->template->msg = 1;
                    }
                    $image = $this->company->get_by_id($_POST['company_id']);
                    $id = $this->company->company_id = $_POST['company_id'];
                    $this->company->company_address = $_POST['company_address'];
                    $this->company->company_phone = $_POST['company_phone'];
                    $this->company->company_date = $_POST['company_date'];
                    $this->company->company_url = $_POST['company_url'];
                    $this->company->acc_id = $_SESSION['acc_id'];
                    $name = $this->company->company_name = strtoupper($_POST['company_name']);
                    if (!empty($_FILES['company_image']['name'])) {
                        $user_image = $_FILES['company_image']['name'];
                        $user_image = time() . rand(0, 1000) . $user_image;
                        move_uploaded_file($_FILES['company_image']['tmp_name'], Upload_FOLDER . DS . $user_image);
                        $this->company->company_image = $user_image;
                        if (!empty($image) && isset($image->company_image)) {
                            if ($image->company_image != 'company.png') {
                                unlink("img/" . $image->company_image);
                            }
                        }
                    } else {
                        $this->company->company_image = $image->company_image;
                    }
                    if ($this->company->update($id) >= 1) {
                        if (isset($_SESSION['user_id'])) {
                            $this->act->act_datetime = date(DateTime::ATOM);
                            $this->act->act_details = $name . 'تم تعديل بيانات شركه ';
                            $this->act->user_id = $_SESSION['user_id'];
                            $this->act->acc_id = $_SESSION['acc_id'];
                            $this->act->type = 'company';
                            if ($this->act->insert() >= 1) {
                                $this->template->msg = 1;
                            } else {
                                $this->template->msg = -1;
                            }
                        }
                        $this->template->msg = 1;
                    }
                } catch (Exception $exc) {
                    $m = $exc->getMessage();
                    $this->template->error = $m;
                    $this->template->msg = -1;
                    $this->template->render("company/profile");
                }
            }
            $this->template->render('company/profile');
        }
    }

}

?>