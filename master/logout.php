<?php

//logout.php

include('interest/config.php');
require_once __DIR__ . '\interest\vendor\autoload.php';
include "../constants.php";
   
session_start();    
$accesstoken=$_SESSION['access_token'];

//Unset token and user data from session        
unset($_SESSION['access_token']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_last_name']);
unset($_SESSION['user_email_address']);
unset($_SESSION['user_image']);
unset($_SESSION['club_login']);
unset($_SESSION['hash_key']);

//Reset OAuth access token    
$client = new Google_Client();

//$client->revokeToken();    
$client->revokeToken($accesstoken);

//Destroy entire session    
session_destroy();



//Redirect to homepage        
header('Location:'.BASE_URL.''); 


?>