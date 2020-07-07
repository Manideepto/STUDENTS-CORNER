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
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: home.php");
		exit;
    }
    
require("../libs/config.php");

if(isset($_POST["export"])){
	try {
        $stmt = $DB->prepare("SELECT * FROM mp_interested WHERE `event_id` = :eid AND `org_id` = :oid");
        $stmt->bindValue(":eid", intval(db_prepare_input($_SESSION['interest_event'])));
		$stmt->bindValue(":oid", db_prepare_input($_SESSION['org_id']));
        $stmt->execute();
        $details = $stmt->fetchAll();
		
		// echo "<pre>";
		// print_r($details); 
	    // echo "</pre>";
		$timestamp = time();
		$filename = 'Interested_students' . $timestamp . '.xls';
		
		header("Content-Type: application/octet-stream");


		$columnHeader = '';  		
		$columnHeader = "Name" . "\t" . "Email" . "\t"; 
		$setData = '';
		
		$isPrintHeader = false;
		foreach ($details as $row) {
			if (! $isPrintHeader) {
				echo $columnHeader . "\n";
				$isPrintHeader = true;
			}
			echo $row["interested_name"];
			echo "\t";
			echo $row["interested_email"]. "\t";
			echo "\n";  
			} 

			header("Content-type: application/octet-stream");  
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Pragma: no-cache");  
			header("Expires: 0");  

			// echo "<a href='manage_events.php'>Go back </a>";

		exit();

	
	} catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
	}


}

?>


<div class="btn">
<form action="interested_events.php" method="post">
	<button type="submit" id="btnExport" name='export'
		value="Export to Excel" class="btn btn-info">Export
		to Excel</button>
</form>
</div>

<?php
include("footer.php");
?>

