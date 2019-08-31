<?php

class Report {

    private $template;

    public function __construct() {
        $this->template = new Template();
    }

    function indexAction() {//this cod should take to the page activity , report ....
        if (!isset($_SESSION['role'])) {
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

    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $this->template->render('report/show');
        }
       
    }

    function showuserAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->template->render('report/showuser');
        }
    }

    function showcompanyAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            $this->template->render('report/showcompany');
        }
    }

}

?>