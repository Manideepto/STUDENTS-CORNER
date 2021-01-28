<?php

//logout.php

include('interest/config.php');
include "../constants.php";

   
session_start();    

$page = $_GET['org_id'];

$accesstoken=$_SESSION['access_token'];

//Unset token and user data from session        
unset($_SESSION['access_token']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_last_name']);
unset($_SESSION['user_email_address']);
unset($_SESSION['user_image']);
unset($_SESSION['club_login']);
unset($_SESSION['all_events']);
unset($_SESSION['url']);


//Reset OAuth access token    
$google_client->revokeToken($accesstoken);

//Destroy entire session    
session_destroy();

//Redirect to club homepage        
header('Location:'.BASE_URL.'/'.$page.''); 


?>
