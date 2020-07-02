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
		$sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_GET['org_id']. "' ORDER BY date ASC";
		}else{
			$sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_GET['org_id']. "' AND blog_id = '" .$_GET['blog_id']. "' ORDER BY date ASC";
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