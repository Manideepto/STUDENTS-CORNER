<?php

//logout.php

include('config.php');
require("../../libs/config.php");

	$sql = "DELETE FROM mp_interested WHERE `event_id`='".$_SESSION['event_id']."' AND `org_id`='".$_SESSION['org_id']."' AND interested_email = '" .$_SESSION['user_email_address']. "'";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
		if ($stmt->rowCount() > 0) {
			$sql = "SELECT * FROM mp_interested WHERE org_id = '".$_SESSION['org_id']."' AND event_id = '".$_SESSION['event_id']."' ORDER BY interested_name ASC";
			$stmt_count = $DB->prepare($sql);
			$stmt_count->execute();
			$count=$stmt_count->rowCount();
				
			$count_interested = intval(db_prepare_input($count));
			$sql = "UPDATE mp_events SET `count_interested` =  :cnt WHERE `event_id` = :eid AND `org_id` = :oid";
			$stmt = $DB->prepare($sql);
			$stmt->bindValue(":cnt", $count_interested);
			$stmt->bindValue(":eid", $_SESSION['event_id']);
			$stmt->bindValue(":oid", $_SESSION['org_id']);
			$stmt->execute();
			
			$message = "Your interest from this event has been revoked successfully.";
		} else {
			$message = "There is an error in revoking your interest. Please logout and try again.";
		}
    } catch (Exception $ex) {
        $message = errorMessage($ex->getMessage()).". Please logout and try again.";
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
	echo'<div class="container">
		<br />
		<img src="iim_logo.PNG" height="100" width="100" align="middle"/> <br>
		<br />
	<div class="panel panel-default">';
	echo '<div class="panel-heading">Welcome '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</div><div class="panel-body">';
	echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" width="100" align="middle"/>';
	echo '<h5>'.$message.'</h5>';
	echo'</div>
		</div>';
   ?>
 </body>
</html>