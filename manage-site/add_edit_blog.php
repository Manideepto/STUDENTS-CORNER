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

$msg = '';
if (isset($_POST["sub"])) {


    $blog_id = db_prepare_input($_POST["blog_id"]);
    $blog_title = db_prepare_input($_POST["blog_title"]);
    $blog_data = db_prepare_input($_POST["blog_data"]);
    $blog_date = db_prepare_input($_POST["blog_date"]);
    // $meta_keywords = db_prepare_input($_POST["meta_keywords"]);
    // $meta_desc = db_prepare_input($_POST["meta_desc"]);
    // $sort_order = (int) db_prepare_input($_POST["sort_order"]);
    $status = db_prepare_input($_POST["status"]);
    // $page_alias = db_prepare_input($_POST["page_alias"]);
    $org_id = db_prepare_input($_SESSION["org_id"]);

    $status = ($status <> "") ? $status : "I";


    if ($blog_title <> "" && $status <> "") {


        if ($blog_id <> "") {

            $sql = "UPDATE mp_blogs SET  `blog_title` =  :bt, "
                    . " `blog_data` =  :bdata,"
                    . " `date` =  :bdate,"
                    . " `status` =  :status,"
                    . " `org_id` =  :oid"
                    . " WHERE `blog_id` = :bid";
            
            
            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":bt", $blog_title);
                $stmt->bindValue(":bdata", $blog_data);
                $stmt->bindValue(":bdate", $blog_date);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":bid", $blog_id);
                $stmt->bindValue(":oid", $org_id);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $msg = successMessage("Page update successfully");
                }  else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
                } else {
                    $msg = errorMessage("Failed to update page");
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            
        } else {
            $sql = "INSERT INTO mp_blogs (`org_id`, `blog_title`, `blog_data`, `date`, `status`) VALUES 
				(:oid,:bt, :bdata, :bdate,:status)";

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":bt", $blog_title);
                $stmt->bindValue(":bdata", $blog_data);
                $stmt->bindValue(":bdate", $blog_date);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":oid", $org_id);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $msg = successMessage("Page added successfully");
                } else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
                } else {
                    $msg = errorMessage("Failed to add page");
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }

          
        }
    } else {
        $msg = errorMessage("All fields are mandatory");
    }
}

if (isset($_GET["edit"]) && $_GET["edit"] != "") {
    $pageTitle = "Edit Blog";
    try {
        $stmt = $DB->prepare("SELECT * FROM mp_blogs WHERE `blog_id` = :bid");
        $stmt->bindValue(":bid", intval(db_prepare_input($_GET["edit"])));
        $stmt->execute();
        $details = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
} else {
    $pageTitle = "Add Blog";
}

include("header.php");

$sql = "SELECT * FROM mp_blogs WHERE status = 'A' ORDER BY blog_title ASC";
try {
    $stmt = $DB->prepare($sql);
    $stmt->execute();
    $optionsRs = $stmt->fetchAll();
} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
}
?>   
<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#blog_data").cleditor();
    });

</script>


<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action="" name="blog">
        <input type="hidden" name="blog_id" value="<?php echo $details[0]["blog_id"]; ?>"  />
               
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Title: </td>
                <td><input type="text" name="blog_title" id="blog _title" class="textboxes" value="<?php echo stripslashes($details[0]["blog_title"]); ?>" autocomplete="off"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Date: </td>
                <td><input type="date" name="blog_date" id="date" class="textboxes" value="<?php echo stripslashes($details[0]["date"]); ?>" autocomplete="off" /> </td>
            </tr>
      
            <tr>
                <td class="formLeft">Description: </td>
                <td>
                    <textarea name="blog_data" id="blog_data"><?php echo stripslashes($details[0]["blog_data"]); ?></textarea>
                </td>
            </tr>
       
            <tr>
                <td class="formLeft"><span class="required">*</span>Status : </td>
                <td>     
                    <?php if (isset($_REQUEST["edit"]) && $_REQUEST["edit"] != "") { ?>
                        <label><input type="radio" name="status" value="A" <?php echo ($details[0]["status"] == 'A') ? 'checked' : ''; ?>  />Active</label> &nbsp; 
                        <label><input type="radio" name="status" value="I" <?php echo ($details[0]["status"] == 'I') ? 'checked' : ''; ?>  />Inactive</label>
                    <?php } else { ?>
                        <label><input type="radio" name="status" value="A" checked  />Active</label> &nbsp; <label><input type="radio" name="status" value="I"  />Inactive</label>
                    <?php } ?>

                </td>
            </tr>
            <tr>
                <td></td>
                <td> <input type="submit" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_blog.php';" value="back to lists" /> </td>
            </tr>       
        </table>
    </form>
</div>

<!--  -->


<!--  -->
<?php
include("footer.php");
?>