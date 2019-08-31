<?php

session_start();
// require_once 'mailerClass/class.php';

require_once 'mailerClass/PHPMailerAutoload.php';

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "sabscustomerservice@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "ABS01016013070";

//Set who the message is to be sent from
$mail->setFrom('sabscustomerservice@gmail.com', 'ABS');
$send = false;
if (isset($_SESSION['contacts_data'])) {

    foreach ($_SESSION['contacts_data'] as $conn) {

        $mail->addAddress($conn['contact_email'], 'name');
//Set the subject line
        $mail->Subject = 'ABS Company';
        $mail->Body = "Subject : " . $_SESSION['email_content'] . "<br> Email ID : " . $conn['contact_email'] . " <br> Phone No: 01010005895\"</b>";
//Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        $mail->isHTML(true);
//Attach an image file
        if (isset($_SESSION['email_attach'])) {
            $mail->addAttachment('attachment/' . $_SESSION['email_attach']);
//send the message, check for errors
        }
        if (!$mail->send()) {
            $send = false;
        } else {
            $send = true;
        }
    }
    
    if ($send == TRUE) {
        header('location:index.php?rt=Email/backsendajax&r=1');
    } else {
        header('location:index.php?rt=Email/backsendajax&r=-1');
    }
} else {
    if(isset($_SESSION['email'])){
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
    $mail->addAddress($_SESSION['email'], 'name');

//Set the subject line
    $mail->Subject = 'ABS Company';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    $mail->Body = "Subject : " . $_SESSION['email_content'] . "<br> Email ID : " . $_SESSION['email'] . " <br> Phone No: 01010005895\"</b>";

//Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';
    $mail->isHTML(true);
//Attach an image file
    if (isset($_SESSION['email_attach'])) {
        $mail->addAttachment('attachment/' . $_SESSION['email_attach']);
//send the message, check for errors
    }
    if (!$mail->send()) {
        //echo "Mailer Error: " . $mail->ErrorInfo;
        if (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/sendother") {
            header("Location:index.php?rt=Email/sendother&msg=-1");
        } elseif (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/send") {
            header("Location:index.php?rt=Email/send&msg=-1");
        } elseif (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/senduser") {
            header("Location:index.php?rt=Email/senduser&msg=-1");
        } else {
            
        }
    } else {
//header("Location:index.php");    
        if (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/sendother") {
            header("Location:index.php?rt=Email/backsendother");
        } elseif (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/send") {
            header("Location:index.php?rt=Email/backsend");
        } elseif (explode("=", $_SERVER['HTTP_REFERER'])[1] == "Email/senduser") {
            header("Location:index.php?rt=Email/backsenduser");
        } else {
            
        }
    }
}}
?>