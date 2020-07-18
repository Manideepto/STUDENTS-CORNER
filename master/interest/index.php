<?php

//index.php

//Include Configuration File
include('config.php');
require("../../libs/config.php");

$login_button = '';
if(isset($_GET["event_id"]))
{
	$_SESSION['event_id']=$_GET["event_id"];
}
if(isset($_GET["org_id"]))
{
	$_SESSION['org_id']=$_GET["org_id"];
}
if(isset($_GET["all_events"]))
{
	$_SESSION['all_events']=$_GET["all_events"];
}
if(isset($_GET["club_login"]) && !isset($_SESSION['club_login']))
{
	$_SESSION['club_login']=$_GET["club_login"];
}

if($_SESSION['club_login']=="true" && empty($_SESSION['event_id']))
{
	if(isset($_SESSION['all_events']) && $_SESSION['all_events']=="true")
	{
		$_SESSION['all_events']=false;
		header('location: ../../all_events');
	}
	else
		header('location: ../../'.$_SESSION['org_id'].'');
}

if(!empty($_SESSION['event_id'])){
	try {
		$sql = "SELECT * FROM mp_interested WHERE org_id = '" .$_SESSION['org_id']. "' AND event_id = '" .$_SESSION['event_id']. "' AND interested_email = '" .$_SESSION['user_email_address']. "' ORDER BY interested_name ASC";
		$stmt = $DB->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount() > 0){
			$message = "Your response had earlier already been recorded. Do you want to revoke your interest? <h5><a href='revoke_interest.php'>Yes</h5></div>";
		}
		else{
			$event_id = intval(db_prepare_input($_SESSION['event_id']));
			$org_id = db_prepare_input($_SESSION['org_id']);
			$interested_name = db_prepare_input($_SESSION['user_first_name']." ".$_SESSION['user_last_name']);
			$interested_email = db_prepare_input($_SESSION['user_email_address']);
			$interested_phone = db_prepare_input("1234567890");
			$sql = "INSERT INTO mp_interested (`event_id`, `org_id` ,`interested_name`, `interested_email`, `interested_phone`) VALUES 
			(:eid, :oid,:i_n,:i_e,:i_p)";
			$stmt = $DB->prepare($sql);
			$stmt->bindValue(":eid", $event_id);
			$stmt->bindValue(":oid", $org_id);
			$stmt->bindValue(":i_n", $interested_name);
			$stmt->bindValue(":i_e", $interested_email);
			$stmt->bindValue(":i_p", $interested_phone);
					
			$stmt->execute();
			if ($stmt->rowCount() > 0) {
				$sql = "SELECT * FROM mp_interested WHERE org_id = '" .$_SESSION['org_id']. "' AND event_id = '".$_SESSION['event_id']."' ORDER BY interested_name ASC";
				$stmt_count = $DB->prepare($sql);
				$stmt_count->execute();
				$count=$stmt_count->rowCount();
						
				$count_interested = intval(db_prepare_input($count));
				$sql = "UPDATE mp_events SET `count_interested` =  :cnt WHERE `event_id` = :eid AND `org_id` = :oid";
				$stmt = $DB->prepare($sql);
				$stmt->bindValue(":cnt", $count_interested);
				$stmt->bindValue(":eid", $event_id);
				$stmt->bindValue(":oid", $org_id);
				$stmt->execute();
						
				$message = "Your interest has been successfully recorded";
			}else {
				$message = "Your interest could not be recorded. Please logout and try again";
			}
		}
		} catch (Exception $ex) {
				$message = errorMessage($ex->getMessage()).". Please logout and try again";
		}
}
		
//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
 //It will Attempt to exchange a code for an valid authentication token.
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
 if(!isset($token['error']))
 {
   //Set the access token used for requests
   $google_client->setAccessToken($token['access_token']);

   //Store "access_token" value in $_SESSION variable for future use.
   $_SESSION['access_token'] = $token['access_token'];

   //Create Object of Google Service OAuth 2 class
   $google_service = new Google_Service_Oauth2($google_client);

   //Get user profile data from google
   $data = $google_service->userinfo->get();

   if(!empty($data['email']))
   {
	    if(strpos($data['email'], '@iima.ac.in') !== false)
	    {
		    //Below you can find Get profile data and store into $_SESSION variable
			if(!empty($data['given_name']))
			{
			  $_SESSION['user_first_name'] = $data['given_name'];
			}

			if(!empty($data['family_name']))
			{
			   $_SESSION['user_last_name'] = $data['family_name'];
			}

			if(!empty($data['email']))
			{
			  $_SESSION['user_email_address'] = $data['email'];
			}

			if(!empty($data['gender']))
			{
			  $_SESSION['user_gender'] = $data['gender'];
			}

			if(!empty($data['picture']))
			{
			  $_SESSION['user_image'] = $data['picture'];
			}
			if(!empty($_SESSION['club_login']) && $_SESSION['club_login']=="false")
			{
				$_SESSION['club_login']="true";
				if(isset($_SESSION['all_events']) && $_SESSION['all_events']=="true")
				{
					$_SESSION['all_events']=false;
					header('location: ../../all_events');
				}
				else
					header('location: ../../'.$_SESSION['org_id'].'');
			}
		}							 
		else{
				$login_button = '<html><body>Please enter your IIMA mail id......</body><h4><a href="logout.php">Close</h4></html>';
		}
	}	  

 }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['access_token']) && $login_button == '')
{
 //Create a URL to obtain user authorization
 $login_button = '<script type="text/javascript"> window.location = "'.$google_client->createAuthUrl().'";</script>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
 </head>
 <body>
   <?php
   if($login_button == '')
   {
		echo'<div class="container">
			<br />
			<img src="iim_logo.png" height="100" width="100" align="middle"/> <br>
			<br />
		<div class="panel panel-default">';
		echo '<div class="panel-heading">Welcome '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</div><div class="panel-body">';
		echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" width="100" align="middle"/>';
		echo '<h5>'.$message.'</h5>';
		echo'</div>
			 </div>';
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
 </body>
</html>