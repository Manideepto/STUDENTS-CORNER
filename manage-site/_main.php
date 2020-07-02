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

$pageTitle = "Manage Tagline for home page";
$msg = '';
if (isset($_POST["sub"])) {


    $id = db_prepare_input($_POST["id"]);
    $tagline2 = db_prepare_input($_POST["tagline2"]);
    $tagline1 = db_prepare_input($_POST["tagline1"]);
    $about = db_prepare_input($_POST["about"]);
    $email = db_prepare_input($_POST["email"]);
    $facebookLink = db_prepare_input($_POST["facebookLink"]);
    $instagramLink = db_prepare_input($_POST["instagramLink"]);
    $linkedinLink = db_prepare_input($_POST["linkedinLink"]);
    $orgName = db_prepare_input($_POST["org_name"]);

    if ($tagline2 <> "" && $tagline1 <> "" && $id <> "") {
        $sql = "UPDATE mp_main SET `org_name` = :orgname, `tagline1` = :tg1, `tagline2` = :tg2,`about` = :about, `facebookLink`= :fb, `instagramLink`= :insta, `linkedinLink`= :lkdin, `email`= :email WHERE `id` = :id ";

        try {
            $stmt = $DB->prepare($sql);
            $stmt->bindValue(":orgname", $orgName);
            $stmt->bindValue(":tg1", $tagline1);
            $stmt->bindValue(":tg2", $tagline2);
            $stmt->bindValue(":about", $about);  
            $stmt->bindValue(":fb", $facebookLink);
            $stmt->bindValue(":insta", $instagramLink);
            $stmt->bindValue(":lkdin", $linkedinLink);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":id", $id);

            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $msg = successMessage("Record updated successfully");
            } else if ($stmt->rowCount() == 0) {
                    $msg = successMessage("No changes affected");
            } else {
                $msg = errorMessage("Failed to update record");
            }
        } catch (Exception $ex) {
            echo errorMessage($ex->getMessage());
        }
    } else {
        $msg = errorMessage("All fields are mandatory");
    }
}


include("header.php");
try {
    $stmt = $DB->prepare("SELECT * FROM mp_main WHERE org_id = '" .$_SESSION['org_id']. "' LIMIT 1");
    $stmt->execute();
    $details = $stmt->fetchAll();
} catch (Exception $ex) {
    echo errorMessage($ex->getMessage());
}
?>   
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<?php echo $msg; 
?>
<div class="formField">      
    <form method="post" action="" name="pages">
        <input type="hidden" name="id" value="<?php echo $details[0]["id"]; ?>"  />
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Organization Name: </td>
                <td><input type="text" name="org_name" id="org_name" class="textboxes" value="<?php echo stripslashes($details[0]["org_name"]); ?>" autocomplete="off" /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Tagline1: </td>
                <td><input type="text" name="tagline1" id="tagline1" class="textboxes" value="<?php echo stripslashes($details[0]["tagline1"]); ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Tagline2: </td>
                <td><input type="text" name="tagline2" id="tagline2" class="textboxes" value="<?php echo stripslashes($details[0]["tagline2"]); ?>" autocomplete="off" /> </td>
            </tr>

            
            <tr>
                <td class="formLeft"><span class="required">*</span>About Us </td>
                <td><textarea cols="60" name="about" id="about"><?php echo stripslashes($details[0]["about"]); ?></textarea> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Email: </td>
                <td><input type="email" name="email" id="email" class="textboxes" value="<?php echo stripslashes($details[0]["email"]); ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Linked Link: </td>
                <td><input type="text" name="linkedinLink" id="linkedin" value="<?php echo stripslashes($details[0]["linkedinLink"]); ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Facebook Link: </td>
                <td><input type="text" name="facebookLink" id="facebook" class="textboxes" value="<?php echo stripslashes($details[0]["facebookLink"]); ?>" autocomplete="off" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Instagram Link: </td>
                <td><input type="text" name="instagramLink" id="instagram" class="textboxes" value="<?php echo stripslashes($details[0]["instagramLink"]); ?>" autocomplete="off" /> </td>
            </tr>
            <tr>    
                <td></td>
                <td> <input type="submit" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'home.php';" value="back to home" /> </td>
            </tr>       
          
        </table>
    </form>
</div>



<div class="formField">      
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $details[0]["id"]; ?>"  />
        <table id="tableForm">
        <!-- <tr><td>
            Select Logo:
        <input type="file" name="logo"></td></tr>
        <tr><td>
            Select Photo1:
        <input type="file" name="photo1"></td></tr>
        <tr><td>
        Select Photo2:
        <input type="file" name="photo2"></td></tr>
        <tr><td>
        Select Photo3:
        <input type="file" name="photo3"></td></tr>
        <tr><td>
        Select Photo4:
        <input type="file" name="photo4"></td></tr>
        <tr><td>    
        <input type="submit" name="submitImages" value="Upload">
        </td></tr> -->
        <tr><td>
        Upload images    
        </td></tr>
    <tr><td>
        <a href="upload_photo.php?id=<?php echo $details[0]["id"]; ?>&org_id=<?php echo $_SESSION['org_id']; ?>&page=main&name=Logo">Logo</a> | 
        <a href="upload_photo.php?id=<?php echo $details[0]["id"]; ?>&org_id=<?php echo $_SESSION['org_id']; ?>&page=main&name=Photo1">Photo1</a> | 
        <a href="upload_photo.php?id=<?php echo $details[0]["id"]; ?>&org_id=<?php echo $_SESSION['org_id']; ?>&page=main&name=Photo2">Photo2</a> | 
        <a href="upload_photo.php?id=<?php echo $details[0]["id"]; ?>&org_id=<?php echo $_SESSION['org_id']; ?>&page=main&name=Photo3">Photo3</a> | 
        <a href="upload_photo.php?id=<?php echo $details[0]["id"]; ?>&org_id=<?php echo $_SESSION['org_id']; ?>&page=main&name=Photo4">Photo4</a>
        </td></tr>
    
        </table>
    </form>
</div>

<?php
include("footer.php");
?>