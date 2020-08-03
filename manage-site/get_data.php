<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */

session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	// 	header("location: home.php");
	// 	exit;
	// }


require("../libs/config.php");


$fetch_data = false;

if ($_GET['page'] == 'events'){

	 if ( is_null($_GET['event_id'])){
		//get all
		 $sql = "SELECT * FROM mp_events WHERE org_id = '" .$_GET['org_id']. "' ORDER BY event_title ASC, event_id DESC";
	
	}else{
	 	$sql = "SELECT * FROM mp_events WHERE org_id = '" .$_GET['org_id']. "' AND event_id = '" .$_GET['event_id']. "' ORDER BY event_title ASC, event_id DESC";
		
	}
$fetch_data= true;

}elseif($_GET['page'] == 'members'){
	
	if ( is_null($_GET['mem_id'])){
		//get all
		$sql = "SELECT * FROM mp_members WHERE org_id = '" .$_GET['org_id']. "' ORDER BY name ASC";
		
		}else{
			 $sql = "SELECT * FROM mp_members WHERE org_id = '" .$_GET['org_id']. "' AND mem_id = '" .$_GET['mem_id']. "' ORDER BY name ASC";
			
		}	
$fetch_data = true;
}elseif($_GET['page'] == 'index'){
	
			 $sql = "SELECT org_id, org_name, logo, about FROM mp_main ORDER BY org_id";
			
		
$fetch_data = true;
}elseif($_GET['page'] == 'pages'){
	
	if ( is_null($_GET['page_id'])){
		//get all
		$sql = "SELECT * FROM mp_pages WHERE org_id = '" .$_GET['org_id']. "'";
		
		}else{
			 $sql = "SELECT * FROM mp_pages WHERE org_id = '" .$_GET['org_id']. "' AND page_id = '" .$_GET['page_id']. "'";	
		}	
$fetch_data = true;
}elseif($_GET['page'] == 'main'){
	
			 $sql = "SELECT * FROM mp_main WHERE org_id = '" .$_GET['org_id']. "'";	

$fetch_data = true;
}elseif($_GET['page'] == 'blogs'){
	
	if ( is_null($_GET['blog_id'])){
		$sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_GET['org_id']. "' ORDER BY date DESC";
		}else{
			$sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_GET['org_id']. "' AND blog_id = '" .$_GET['blog_id']. "' ORDER BY date DESC";
		}
$fetch_data = true;
}
elseif($_GET['page'] == 'upcoming_events'){
			
			$sql = "SELECT * FROM mp_events WHERE org_id = '" .$_GET['org_id']. "'AND status='A' ORDER BY event_date DESC, count_interested DESC LIMIT 2";	

$fetch_data = true;
}
elseif($_GET['page'] == 'recent_blogs'){
	
			 $sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_GET['org_id']. "'AND status='A' ORDER BY date DESC LIMIT 2";	

$fetch_data = true;
}
elseif($_GET['page'] == 'reg_link'){
	
		$sql = "SELECT * FROM mp_interested WHERE org_id = '" .$_GET['org_id']. "' AND event_id = '" .$_GET['event_id']. "' AND interested_email = '" .$_GET['user_id']. "'";	

$fetch_data = true;
}
elseif($_GET['page'] == 'all_events'){
	
		$sql = $sql = "SELECT * FROM mp_events ORDER BY event_date DESC, count_interested DESC, event_title ASC, event_id DESC";
		
$fetch_data = true;
}
elseif($_GET['page'] == 'org_events'){
	
		if($_GET['interest_sel'] == 'interest')
		{
			if($_GET['org_id']== 'all')
				$sql = "SELECT * FROM mp_events e INNER JOIN mp_interested i ON e.org_id = i.org_id AND e.event_id = i.event_id WHERE i.interested_email = '" .$_SESSION['user_email_address']. "' ORDER BY e.event_date DESC, e.count_interested DESC, e.event_title ASC, e.event_id DESC";
			else
				$sql = "SELECT * FROM mp_events e INNER JOIN mp_interested i ON e.org_id = i.org_id AND e.event_id = i.event_id WHERE e.org_id = '" .$_GET['org_id']. "' AND i.interested_email = '" .$_SESSION['user_email_address']. "' ORDER BY e.event_date DESC, e.count_interested DESC, e.event_title ASC, e.event_id DESC";
		}
		else if($_GET['interest_sel'] == 'not_interested')
		{
			if($_GET['org_id']== 'all')
				$sql = "SELECT * FROM mp_events WHERE event_id <> ALL (SELECT event_id from mp_interested WHERE interested_email = '" .$_SESSION['user_email_address']. "') ORDER BY event_date DESC, count_interested DESC";
			else
				$sql = "SELECT * FROM mp_events WHERE org_id = '" .$_GET['org_id']. "' AND event_id <> ALL (SELECT event_id from mp_interested WHERE interested_email = '" .$_SESSION['user_email_address']. "') ORDER BY event_date DESC, count_interested DESC";
			}
		else if($_GET['interest_sel'] == 'all')
		{
			if($_GET['org_id']== 'all')
				$sql = "SELECT * FROM mp_events ORDER BY event_date DESC, count_interested DESC, event_title ASC, event_id DESC";
			else
				$sql = "SELECT * FROM mp_events WHERE org_id = '" .$_GET['org_id']. "' ORDER BY event_date DESC, count_interested DESC, event_title ASC, event_id DESC";
		
		}
		
$fetch_data = true;
}



if($fetch_data){
		

try {
	$stmt = $DB->prepare($sql);

    $stmt->execute();
	$results = $stmt->fetchAll();
//$results = $stmt->get_result();

} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
}

echo json_encode($results);
$fetch_data = false;	
}
?>
