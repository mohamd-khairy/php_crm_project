<?php

class Post {

    private $template;
    private $post;
    private $valid;
    private $chat;
    private $msg;

    public function __construct() {
        $this->template = new Template();
        $this->post = new PostsModel();
        $this->valid = new Validation();
        $this->chat = new ChatModel();
        $this->msg = new MsgModel();
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

    function addmsgAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->msg->chat_id = $_GET['chat_id'];
            $this->msg->msg_content = $_GET['msg_content'];
            $this->msg->acc_id = $_SESSION['acc_id'];
            $this->msg->msg_datetime = date(DateTime::ATOM);
            if (isset($_SESSION['user_id'])) {
                $this->msg->speak_id = $_SESSION['user_id'];
            } else {
                $this->msg->speak_id = $_SESSION['acc_id'];
            }
            $this->msg->insert();
        }
    }

    function messageAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $msgs = MsgModel::getAllDataby_chat_id($_GET['chat_id']);
            foreach ($msgs as $msg) {
                echo' <div class="box-comment">';
                if (isset($_SESSION['user_id'])) {
                    if ($msg['speak_id'] == $_SESSION['user_id']) {
                        $post_data = UserModel::getAllDatabyid($msg['speak_id']);
                        echo '      <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">' . $post_data[0]['user_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-left">' .
                        date('h:i A D-M', strtotime($msg['msg_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                     <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['user_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text" style="direction: rtl">
                                           ' . $msg['msg_content'] . '
                                        </div>

                                        <!-- /.direct-chat-text -->
                                    </div> ';
                    } else {
                        $post_data = UserModel::getAllDatabyid($msg['speak_id']);
                        if (!empty($post_data)) {
                            echo '  <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"> ' . $post_data[0]['user_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-right"> ' .
                            date('h:i A D-M', strtotime($msg['msg_datetime']))
                            . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['user_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ' . $msg['msg_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->';
                        } else {
                            $post_data = AccountModel::getAllDatabyid($msg['speak_id']);
                        }
                        echo '  <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"> ' . $post_data[0]['acc_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-right"> ' .
                        date('h:i A D-M', strtotime($msg['msg_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['acc_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ' . $msg['msg_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->';
                    }
                } else {
                    if ($msg['speak_id'] == $_SESSION['acc_id']) {
                        $post_data = AccountModel::getAllDatabyid($msg['speak_id']);
                        echo '      <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">' . $post_data[0]['acc_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-left">' .
                        date('h:i A D-M', strtotime($msg['msg_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                     <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['acc_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text" style="direction: rtl">
                                           ' . $msg['msg_content'] . '
                                        </div>

                                        <!-- /.direct-chat-text -->
                                    </div> ';
                    } else {
                        $post_data = UserModel::getAllDatabyid($msg['speak_id']);
                        if (!empty($post_data)) {
                            echo '  <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"> ' . $post_data[0]['user_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-right"> ' .
                            date('h:i A D-M', strtotime($msg['msg_datetime']))
                            . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['user_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ' . $msg['msg_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->';
                        }
                    }
                }
                echo '</div>';
            }
        }
    }

    function headerAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {

            if (!isset($_SESSION['user_id'])) {

                $user = UserModel::getAllDatabyid($_GET['speak2_id']);


                echo '     <div class="user-block">
                            <img class="img-circle" src="' . HostName . DS . 'img' . DS . $user[0]['user_image'] . '" alt="User Image">
                            <span class="username"><a href="#">' . $user[0]['user_name'] . '</a></span>
                        <span class="description" >' . $user[0]['role'] . '</span>

</div>';
            } else {
                $manager = AccountModel::getAllDatabyid($_GET['speak2_id']);
                if (!empty($manager)) {
                    echo '   <div class="user-block">
                            <img class="img-circle" src="' . HostName . DS . 'img' . DS . $manager[0]['acc_image'] . '" alt="User Image">
                            <span class="username"><a href="#">' . $manager[0]['acc_name'] . '
                                </a></span>
                                                   <span class="description" >' . $manager[0]['role'] . '</span>

</div>';
                } else {
                    $user = UserModel::getAllDatabyid($_GET['speak2_id']);

                    echo '   <div class="user-block">
                            <img class="img-circle" src="' . HostName . DS . 'img' . DS . $user[0]['user_image'] . '" alt="User Image">
                            <span class="username"><a href="#">' . $user[0]['user_name'] . '
                                </a></span>
                                                   <span class="description" >' . $user[0]['role'] . '</span>

</div>';
                }
            }
        }
    }

    function chatAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            if (isset($_SESSION['user_id'])) {
                $speak1 = $_SESSION['user_id'];
            } else {
                $speak1 = $_SESSION['acc_id'];
            }
            $chat = ChatModel::check($speak1, $_GET['speak2_id']);
            $chat2 = ChatModel::check($_GET['speak2_id'], $speak1);
            if (!empty($chat)) {
                echo $chat[0]['chat_id'];
            } elseif (!empty($chat2)) {
                echo $chat2[0]['chat_id'];
            } else {
                $this->chat->acc_id = $_SESSION['acc_id'];
                $this->chat->chat_datetime = date(DateTime::ATOM);
                $this->chat->speak2_id = $_GET['speak2_id'];
                $this->chat->speak1_id = $speak1;
                $chat_id = $this->chat->insert();
                if ($chat_id >= 1) {
                    echo $chat_id;
                } else {
                    header('location:index.php');
                }
            }
        }
    }

    function addajaxAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $this->post->post_content = $_GET['post'];
            $this->post->acc_id = $_SESSION['acc_id'];
            $this->post->post_datetime = date(DateTime::ATOM);
            if (isset($_SESSION['user_id'])) {
                $this->post->user_id = $_SESSION['user_id'];
            } else {
                $this->post->user_id = 0;
            }
            if ($this->post->insert() >= 1) {
                if (isset($_SESSION['user_id'])) {
                    $id = UserModel::getAllDatabyid($_SESSION['user_id']);
                    $this->act->act_datetime = date(DateTime::ATOM);
                    $this->act->act_details = 'بنشر بوست  ' . $id[0]['user_name'] . ' قام ';
                    $this->act->type = 'post';
                    $this->act->user_id = $_SESSION['user_id'];
                    $this->act->acc_id = $_SESSION['acc_id'];
                    $this->act->insert();
                }
            } else {
                echo '  <div class="alert alert-danger h4" role="alert"><strong>خطأ!</strong>..لم تتم الاضافه..  </div>';
            }
        }
    }

    function showAction() {
        if (!isset($_SESSION['acc_id']) && !isset($_SESSION['user_id'])) {
            header('location:index.php?rt=HomePage/logout');
        } else {
            $posts = PostsModel::getAllData_by_acc_id($_SESSION['acc_id']);
            foreach ($posts as $post) {

                echo' <div class="box-comment">';

                if ($post['user_id'] != 0) {
                    $post_data = UserModel::getAllDatabyid($post['user_id']);
                    if ($post['user_id'] == $_SESSION['user_id']) {
                        echo '      <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">' . $post_data[0]['user_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-left">' .
                        date('h:i A D-M', strtotime($post['post_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                     <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['user_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text" style="direction: rtl">
                                           ' . $post['post_content'] . '
                                        </div>

                                        <!-- /.direct-chat-text -->
                                    </div> ';
                    } else {
                        echo '  <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"> ' . $post_data[0]['user_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-right"> ' .
                        date('h:i A D-M', strtotime($post['post_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['user_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ' . $post['post_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->

';
                    }
                } else {
                    $post_data = AccountModel::getAllDatabyid($post['acc_id']);
                    if ($post['acc_id'] == $_SESSION['acc_id'] && !isset($_SESSION['user_id'])) {
                        echo '
                                     <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">' . $post_data[0]['acc_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-left"> 
                                                ' . date('h:i A D-M', strtotime($post['post_datetime']))
                        . ' </span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                       <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['acc_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text" style="direction: rtl">
                                            ' . $post['post_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>';
                    } else {

                        echo '   <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"> ' . $post_data[0]['acc_name'] . '</span>
                                            <span class="direct-chat-timestamp pull-right"> 
                                                ' .
                        date('h:i A D-M', strtotime($post['post_datetime']))
                        . '</span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="' . HostName . DS . 'img' . DS . $post_data[0]['acc_image'] . '" alt="Message User Image"><!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            ' . $post['post_content'] . '
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                    <!-- /.box-comment -->
                                  ';
                    }
                }
                echo '</div>';
            }
        }
    }

}
?>