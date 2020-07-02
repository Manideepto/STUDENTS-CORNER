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
$pageTitle = "Manage Photo";


if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){

    $id = db_prepare_input($_POST["id"]);
    $page = db_prepare_input($_POST["page"]);
    $org_id = db_prepare_input($_POST["org_id"]);
    $main_photos = db_prepare_input($_POST["main_photos"]);

    $targetDir = "upload/";

    $fileName = $page."_".$org_id."_".$id.basename($_FILES["file"]["name"]);
    $fileName = $page."_".$org_id."_".$id.$main_photos.".png";
    // $fileName = $fileName.trim();
    // $fileName = $fileName.replace(/[{()}]/g, '');

    $targetFilePath ="../".$org_id."/".$targetDir.$fileName;
    $localFilePath = $targetDir.$fileName;
    
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

    debug_to_console($id);
    debug_to_console($fileName);
    debug_to_console("target path");
    debug_to_console($targetFilePath);

    $allowTypes = array('jpg','png','jpeg','gif','pdf');

    if(in_array($fileType, $allowTypes)){
            debug_to_console("after allow types");

    if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            debug_to_console("file moved");
        if ($id <> "") {
            debug_to_console("inside before sql");

        if ($page == 'events'){
            $sql = "UPDATE mp_events SET `event_thumbnail` = :photo WHERE `event_id` = :id";
        }elseif($page == 'members'){
            $sql = "UPDATE mp_members SET  `photo` =  :photo WHERE `mem_id` = :id";
        }elseif($page == 'blogs'){
            $sql = "UPDATE mp_blogs SET  `photo` =  :photo WHERE `blog_id` = :id";
        }elseif($page == 'main'){
            $sql = "UPDATE mp_main SET  `".$main_photos."` =  :photo WHERE `id` = :id";
        }
                      
           debug_to_console("inside sql");

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":photo",$localFilePath);
                $stmt->bindValue(":id", $id);   
               
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
   
    $id = db_prepare_input($_POST["id"]);  
    $page = db_prepare_input($_POST["page"]);
    $main_photos = db_prepare_input($_POST["main_photos"]);
    
    if ($page == 'events'){
        $sql = "UPDATE mp_events SET  `event_thumbnail` = NULL WHERE `event_id` = :id";
    }elseif($page == 'members'){
        $sql = "UPDATE mp_members SET  `photo` = NULL WHERE `mem_id` = :id";
    }elseif($page == 'blogs'){
        $sql = "UPDATE mp_blogs SET  `photo` = NULL WHERE `blog_id` = :id";
    }elseif($page == 'main'){
        $sql = "UPDATE mp_main SET  `".$main_photos."` = NULL WHERE `id` = :id";
    }
    
     try {
         $stmt = $DB->prepare($sql);
         $stmt->bindValue(":id", $id);
         
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


include("header.php");

?>

<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>

<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action=" " enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>"  />
        <input type="hidden" name="page" value="<?php echo $_GET['page'];?>"  />
        <input type="hidden" name="org_id" value="<?php echo $_GET['org_id'];?>"  />
        <input type="hidden" name="main_photos" value="<?php echo $_GET['name'];?>"  />

        <table id="tableForm">
        <tr>
                <td class="formLeft"><span class="required">*</span>Upload image of : <?php echo $_GET['name'];?></td>
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
                <!-- <td><input type="button" name="" onclick="javascript:window.location = 'manage_'+'<?php echo $_GET['page'];?>'+'.php';" value="back" /> </td> -->
            </tr> 
         </table>
     
    </form>


<?php
    include("footer.php");
?>