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
$pageTitle = "Manage Members";
$msg = '';
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $sql = "DELETE FROM  mp_members WHERE `mem_id` = :id";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->bindValue(":id", db_prepare_input($_GET["del"]));
        $stmt->execute();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $msg = successMessage("Record deleted successfully");
    } else {
        $msg = errorMessage(mysql_error());
    }
}
include("header.php");
?>   
<?php echo $msg; ?>
<div class="title" style="text-align:right;"><a href="add_edit_member.php">Add Member</a></div>
<table class="bordered">
    <tr>
        <th ><strong>Name</strong> </th>
        <th ><strong>Member Bio</strong> </th>
        <th ><strong>Email</strong> </th>
        <th><strong>Phone</strong> </th>
        <th><strong>Status</strong> </th>
        <th><strong>Action</strong> </th>
    
    </tr>
    <?php
    $sql = "SELECT * FROM  mp_members  WHERE 1 ORDER BY name ASC";
    try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
    foreach ($results as $rs) {
        ?>
        <tr>
            <td ><?php echo stripslashes($rs["name"]); ?></td>
            <td><?php echo stripslashes($rs["mem_bio"]); ?></td>
            <td><?php echo stripslashes($rs["email"]); ?></td>
            <td><?php echo stripslashes($rs["phone"]); ?></td>
            <td><?php echo ($rs["status"] == 'A') ? "Active" : "Inactive"; ?></td>
         
            <td><a href="add_edit_member.php?edit=<?php echo ($rs["mem_id"]); ?>">Edit</a> 
            <a> | </a>  
            <a href="add_member_photo.php?edit=<?php echo ($rs["mem_id"]); ?>">Photo</a>
            <a> | </a>  
          <a href="manage_members.php?del=<?php echo ($rs["mem_id"]); ?>" onclick="return confirm('Are you sure?');">Delete</a> </td>
        </tr>
        <?php
    }
    ?>

<?php
include("footer.php");
?>