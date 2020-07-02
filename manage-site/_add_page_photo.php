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

    $page_id = db_prepare_input($_POST["page_id"]);
    $targetDir = "upload/";
    $fileName = $page_id."_".basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    debug_to_console($page_id);
    debug_to_console($fileName);
    debug_to_console("target path");
    debug_to_console($targetFilePath);

    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(in_array($fileType, $allowTypes)){

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
        if ($page_id <> "") {
           $sql = "UPDATE mp_pages SET  `photo` =  :pphoto WHERE `page_id` = :pid";
           
           debug_to_console("inside sql");

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":pphoto",$targetFilePath);
                $stmt->bindValue(":pid", $page_id);
                
               
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
    $sql = "UPDATE mp_pages SET  `photo` = NULL WHERE `page_id` = :pid";
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
    $pageTitle = "Add page photo";

    try {
        $stmt = $DB->prepare("SELECT * FROM mp_pages WHERE `page_id` = :pid");
        $stmt->bindValue(":pid", intval(db_prepare_input($_GET["edit"])));
        $stmt->execute();
        $details = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
} else {
    $pageTitle = "Add page";
}

include("header.php");


?>   
<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>

<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action=" " enctype="multipart/form-data">
        <input type="hidden" name="page_id" value="<?php echo $details[0]["page_id"]; ?>"  />
        
        <table id="tableForm">
        <tr>
                <td class="formLeft"><span class="required">*</span>Upload image of :  <?php echo stripslashes($details[0]["page_title"]); ?></td>
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
                <td><input type="button" name="" onclick="javascript:window.location = 'manage_pages.php';" value="back to lists" /> </td>
            </tr> 
       


        </table>
  

    
    </form>


<?php
    include("footer.php");
?>