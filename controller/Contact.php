<?php

class Contact {

    private $template;
    private $contact;
    private $act;
    private $valid;
    private $task;
    private $deal;
    private $email;

    public function __construct() {
        $this->template = new Template();
        $this->contact = new ContactModel();
        $this->act = new ActivityModel();
        $this->task = new TaskModel();
        $this->deal = new DealModel();
        $this->valid = new Validation();
        $this->email = new EmailModel();
    }

    function indexAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
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
        // $this->template->render('home');
    }

    function exelAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_SESSION['user_id'])) {
                $this->act->act_datetime = date(DateTime::ATOM);
                $this->act->act_details = 'أخذ ملف إكسل من العملاء';
                $this->act->user_id = $_SESSION['user_id'];
                $this->act->acc_id = $_SESSION['acc_id'];
                $this->act->type = 'contact';
                $this->act->insertCompose();
            }
            $this->template->render('contact/exel');
        }
    }

    function profileajaxAction() {
        try {
            $rules = array(
                "contact_name" => "checkempty|checktext",
                "contact_email" => "checkempty|checkemail",
                "contact_address" => "checkempty",
                "contact_phone" => "checkempty|checkphone",
                "contact_job" => "checkempty|checktext",
                "contact_other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $id = $this->contact->contact_id = $_GET['contact_id'];
            $data = $this->contact->get_by_id($id);
            $name = $this->contact->contact_name = trim($_GET['contact_name']);
            $this->contact->contact_address = $_GET['contact_address'];
            $this->contact->contact_phone = $_GET['contact_phone'];
            $this->contact->contact_job = $_GET['contact_job'];
            $this->contact->company_id = (int) $_GET['company_id'];
            $this->contact->contact_other = $_GET['contact_other'];
            $this->contact->contact_date = $_GET['contact_date'];
            $this->contact->acc_id = (int) $_SESSION['acc_id'];
            $email = $this->contact->contact_email = $_GET['contact_email'];
            $check = ContactModel::checkemail($email);
            if (empty($check) || $email == $data->contact_email) {
                if ($this->contact->update($id) >= 1) {
                    if (isset($_SESSION['user_id'])) {
                        $this->act->act_datetime = date(DateTime::ATOM);
                        $this->act->act_details = $name . 'تم تعديل بيانات ';
                        $this->act->user_id = $_SESSION['user_id'];
                        $this->act->acc_id = $_SESSION['acc_id'];
                        $this->act->type = 'contact';
                        $this->act->insert(); 
                    }
                    echo ' <div class="alert alert-success h5" role="alert">تم الاضافه بنجاح...</div>';
                } else {
                    echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
                }
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..هذا الايميل موجود بالفعل  ..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo "<div class='alert alert-danger h4' role='alert'><strong>خطأ!</strong>$m </div>";
        }
    }

    function profileAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            if (isset($_GET['contact_id']) && $_SESSION['role'] != 'user') {
                $dataa = ContactModel::getAllDatabyid(intval($_GET['contact_id']));
                if (!empty($dataa))
                    $data = $dataa[0];
                if ($data['acc_id'] == $_SESSION['acc_id']) {
                    $this->template->render('contact/profile');
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

    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            if (isset($_GET['pg']) && intval($_GET['pg'])) {

                $current = $_GET['pg'];
            } else {
                $current = 0;
            }
            $this->template->offset = $current;
            $m = ContactModel::getCount($_SESSION['acc_id']);
            $this->template->count = ceil($m['count'] / PER_PAGE_COUNT);
            $this->template->render('contact/show');
        }
    }

    function addajaxAction() {
        try {
            $rules = array(
                "contact_name" => "checkempty|checkstring",
                "contact_address" => "checkempty",
                "contact_email" => "checkempty|checkemail",
                "contact_phone" => "checkempty|checkphone",
                "contact_job" => "checkempty|checktext",
                "company_id" => "checkempty|checkint",
                "contact_other" => "checktext"
            );
            if (!$this->valid->validate($_GET, $rules)) {
                $this->template->msg = 1;
            }
            $name = $this->contact->contact_name = trim($_GET['contact_name']);
            $email = $this->contact->contact_email = $_GET['contact_email'];
            $this->contact->contact_address = $_GET['contact_address'];
            $number = $this->contact->contact_phone = $_GET['contact_phone'];
            $this->contact->contact_job = $_GET['contact_job'];
            $this->contact->company_id = (int) $_GET['company_id'];
            $this->contact->contact_other = $_GET['contact_other'];
            $this->contact->contact_date = date(DateTime::ATOM);
            $acc_id = $this->contact->acc_id = $_SESSION['acc_id'];
            if (empty(ContactModel::checkemail($email))) {
                if (empty(ContactModel::getAllDatabynumber($number))) {
                    if ($this->contact->insert() >= 1) {
                        if (isset($_SESSION['user_id'])) {
                            $this->act->act_datetime = date(DateTime::ATOM);
                            $this->act->act_details = ' الي العملاء' . $name . 'تمت اضافه ';
                            $this->act->user_id = $_SESSION['user_id'];
                            $this->act->acc_id = $_SESSION['acc_id'];
                            $this->act->type = 'contact';
                            $this->act->insert();
                        }
                        echo ' <div class="alert alert-success h5" role="alert">تم الاضافه بنجاح...</div>';
                    } else {
                        echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
                    }
                } else {
                    echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..هذا الرقم موجود بالفعل  ..  </div>';
                }
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..هذا الايميل موجود بالفعل  ..  </div>';
            }
        } catch (Exception $exc) {
            $m = $exc->getMessage();
            echo "<div class='alert alert-danger h4' role='alert'><strong>خطأ!</strong>$m </div>";
        }
    }

    function addAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            $this->template->render("contact/add");
        }
    }

    function deleteAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            $this->template->render('admin/login');
        } else {
            if (isset($_GET['contact_id']) && intval($_GET['contact_id'])) {
                $task = TaskModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $deal = DealModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $mail = EmailModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $call = CallModel::getAllData_by_acc_id($_SESSION['acc_id']);
                $data = ContactModel::getAllDatabyid($_GET['contact_id']);
                if (isset($_SESSION['user_id'])) {
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = ' من الموظفين ' . $data[0]['contact_name'] . 'تم حذف ';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->type = 'contact';
                    $this->act->insert(); 
                }
                $this->contact->delete(intval($_GET['contact_id']), $_SESSION['acc_id']);
                foreach ($deal as $d) {
                    if ($d['contact_id'] == $_GET['contact_id']) {
                        $this->deal->delete($d['deal_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($mail as $m) {
                    if ($m['contact_id'] == $_GET['contact_id']) {
                        $this->email->delete($m['email_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($task as $t) {
                    if ($t['contact_id'] == $_GET['contact_id']) {
                        $this->task->delete($t['task_id'], $_SESSION['acc_id']);
                    }
                }
                foreach ($call as $c) {
                    if ($c['contact_id'] == $_GET['contact_id']) {
                        $this->task->delete($c['call_id'], $_SESSION['acc_id']);
                    }
                }

                echo " <div class='alert alert-danger h4' role='alert'>..تم الحذف.. </div>";
            } else {
                $this->template->msg = -1;
                $this->template->render('errors');
            }
        }
    }

}
