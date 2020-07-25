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

include("header.php");
echo "<h2><b>Event</b>: ".$_GET['name']."</h2><br>";
if (isset($_GET["interest_event"]) && $_GET["interest_event"] != "") {
    $_SESSION['interest_event'] = $_GET["interest_event"];
    try {
        $stmt = $DB->prepare("SELECT * FROM mp_interested WHERE `event_id` = :eid AND `org_id` = :oid");
        $stmt->bindValue(":eid", intval(db_prepare_input($_SESSION['interest_event'])));
		$stmt->bindValue(":oid", db_prepare_input($_SESSION['Admin_org_id']));
        $stmt->execute();
        $details = $stmt->fetchAll();
		$list = '<table class="bordered"><tr><th>Name</th><th>Email</th><th>Phone</th></tr>';
		foreach($details as $row) {
		   $list .= "<tr><td>".$row['interested_name']."</td><td>".$row['interested_email']."</td><td>".$row['interested_phone']."</td></tr>";
		}
		$list .= "</table>";
		echo $list;
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
}

?>
<br>
<br>
<br>
<div class="btn">
<form action="export_interested_events.php" method="post">
	<button type="submit" id="btnExport" name='export'
		value="Export to Excel" class="btn btn-info">Export
		to Excel</button>
</form>
</div>

<?php
include("footer.php");
?>

