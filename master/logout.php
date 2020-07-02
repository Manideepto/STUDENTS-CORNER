<?php

//logout.php

include('interest/config.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy session data.
unset($_SESSION['access_token']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_last_name']);
unset($_SESSION['user_email_address']);
unset($_SESSION['user_image']);
unset($_SESSION['club_login']);
unset($_SESSION['hash_key']);


//redirect page to index.php	
header('location:https://mail.google.com/mail/u/0/?logout&hl=en');

?>