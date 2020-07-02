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
if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

    $event_id = db_prepare_input($_POST["event_id"]);
    $targetDir = "upload/";
    $fileName = $event_id."_".basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    debug_to_console($mem_id);
    debug_to_console($fileName);
    debug_to_console("target path");
    debug_to_console($targetFilePath);

    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(in_array($fileType, $allowTypes)){

if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        if ($event_id <> "") {
           $sql = "UPDATE mp_events SET  `event_thumbnail` =  :ephoto WHERE `event_id` = :eid";
           
           debug_to_console("inside sql");

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":ephoto",$targetFilePath);
                $stmt->bindValue(":eid", $event_id);
                
               
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $msg = successMessage("updated successfully");
                }  else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
                } else {
                    $msg = errorMessage("Failed to upload");
                }

             

            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            
        } 
    }else{
        $msg = errorMessage("Failed to upload image");
    }

}else{
    $msg = errorMessage("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload");
}
}

if(isset($_POST["clear"]) ){
    $sql = "UPDATE mp_pages SET  `event_thumbnail` = NULL WHERE `page_id` = :pid";
    $page_id = db_prepare_input($_POST["page_id"]);  
   
     try {
         $stmt = $DB->prepare($sql);
         //$stmt->bindValue(":mphoto",$nullphoto);
         $stmt->bindValue(":pid", $page_id);
         
         $stmt->execute();
         if ($stmt->rowCount() > 0) {
             $msg = successMessage("updated successfully");
         }  else if ($stmt->rowCount() == 0) {
             $msg = successMessage("No changes affected");
         } else {
             $msg = errorMessage("Failed to update");
         }  

     } catch (Exception $ex) {
         echo errorMessage($ex->getMessage());
     }
 }


if (isset($_GET["edit"]) && $_GET["edit"] != "") {
    $pageTitle = "Add event photo";

    try {
        $stmt = $DB->prepare("SELECT * FROM mp_events WHERE `event_id` = :eid");
        $stmt->bindValue(":eid", intval(db_prepare_input($_GET["edit"])));
        $stmt->execute();
        $details = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
} else {
    $pageTitle = "Add Events";
}

include("header.php");


?>   
<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>

<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action=" " enctype="multipart/form-data">
        <input type="hidden" name="event_id" value="<?php echo $details[0]["event_id"]; ?>"  />
        
        <table id="tableForm">
        <tr>
                <td class="formLeft"><span class="required">*</span>Upload image of :  <?php echo stripslashes($details[0]["event_title"]); ?></td>
        </tr>
            
        <tr><td>
            Select Image File to Upload:
        <input type="file" name="file">
        <input type="submit" name="submit" value="Upload">
        </td></tr>

        <tr><td>
        <input type="submit" name="clear" value="Remove photo">
        </td></tr>


         <tr>
                <td><input type="button" name="" onclick="javascript:window.location = 'manage_events.php';" value="back to lists" /> </td>
            </tr> 
       


        </table>
  

    
    </form>


<?php
    include("footer.php");
?>