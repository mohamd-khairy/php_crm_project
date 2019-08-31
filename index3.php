<?php
include_once("config3.php");
include_once("includes/functions1.php");
//destroy facebook session if user clicks reset
if(!$fbuser){
	$fbuser = null;
	$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
          header('location: '.$loginUrl);
	//$output = '<a href="'.$loginUrl.'"><img src="images/fb_login.png"></a>'; 	
}else{
	$user_profile = $facebook->api('/me?fields=id,first_name,last_name,email,gender,locale,picture');
	$user = new Users();
	$user_data = $user->checkUser('facebook',$user_profile['id'],$user_profile['first_name'],$user_profile['last_name'],$user_profile['email'],$user_profile['gender'],$user_profile['locale'],$user_profile['picture']['data']['url']);
	if(!empty($user_data)){
            $_SESSION['facebook']=$user_data;
                header("location:index.php?rt=HomePage/facebook");

//		$output = '<h1>Facebook Profile Details </h1>';
//		$output .= '<img src="'.$user_data['picture'].'">';
//        $output .= '<br/>Facebook ID : ' . $user_data['oauth_uid'];
//        $output .= '<br/>Name : ' . $user_data['fname'].' '.$user_data['lname'];
//        $output .= '<br/>Email : ' . $user_data['email'];
//        $output .= '<br/>Gender : ' . $user_data['gender'];
//        $output .= '<br/>Locale : ' . $user_data['locale'];
//        $output .= '<br/>You are login with : Facebook';
//        $output .= '<br/>Logout from <a href="logout3.php?logout3">Facebook</a>'; 
	}else{
                            header("location:logout3.php?logout");
		//$output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
	}
}
?>
