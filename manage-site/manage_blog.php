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
$pageTitle = "Manage Blog";
$msg = '';
if (isset($_GET["del"]) && $_GET["del"] != "") {
    $sql = "DELETE FROM  mp_blogs WHERE `blog_id` = :id";
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
<?php echo $msg; 

?>


<div class="title" style="text-align:right;"><a href="add_edit_blog.php">Add Blog</a></div>
<table class="bordered">

    <tr>
        <th ><strong>Title</strong> </th>
        <th ><strong>Date</strong> </th>
        <th><strong>Status</strong> </th>
        <th><strong>Action</strong> </th>
    </tr>
    <?php
    $sql = "SELECT * FROM mp_blogs WHERE org_id = '" .$_SESSION['Admin_org_id']. "'  ORDER BY blog_title ASC, blog_id DESC";
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
            <td ><?php echo stripslashes($rs["blog_title"]); ?></td>
            <td ><?php echo stripslashes($rs["date"]); ?></td>
            <td><?php echo ($rs["status"] == 'A') ? "Active" : "Inactive"; ?></td>
            <td>
            <a href="add_edit_blog.php?edit=<?php echo ($rs["blog_id"]); ?>"><span class='glyphicon glyphicon-pencil'></span></a> 
            <a> | </a>
            <a href="upload_photo.php?id=<?php echo ($rs["blog_id"]); ?>&org_id=<?php echo $_SESSION['Admin_org_id']; ?>&page=blogs&name=<?php echo stripslashes($rs["blog_title"]); ?>"><span class='glyphicon glyphicon-picture'></span></a>
            <a> | </a>  
                <a href="manage_blog.php?del=<?php echo ($rs["blog_id"]); ?>" onclick="return confirm('Are you sure?');"><span class='glyphicon glyphicon-trash'></span></a> </td>
        </tr>
        <?php
    }
    ?>
</table>
<?php
include("footer.php");
?>
