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

include("header.php");

?>   
<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script>

<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action=" " name="members">
        <table id="tableForm">
            
            <tr>
                <td class="formLeft"><span class="required">*</span>Name: </td>
                <td><input type="text" name="name" id="mem_name" class="textboxes"  autocomplete="off"  /> </td>
            </tr>
            
            <tr>
                <td class="formLeft">BIO: </td>
                <td>
                    <textarea name="mem_bio" id="mem_bio"></textarea>
                </td>
            </tr>
            <tr>
                <td class="formLeft">Meta Keywords: </td>
                <td><input type="text" name="meta_keywords" id="meta_keywords" class="textboxes" /> </td>
            </tr>
            <tr>
                <td class="formLeft">Email: </td>
                <td><input type="email" name="email" id="mem_email" class="textboxes" /> </td>
            </tr>

            <tr>
                <td class="formLeft">Contact No: </td>
                <td><input type="number" name="phone" id="mem_phone" class="textboxes" style="width:100px;" value="<?php echo stripslashes($details[0]["phone"]); ?>" /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Status : </td>
                <td>     
                    <?php if (isset($_REQUEST["edit"]) && $_REQUEST["edit"] != "") { ?>
                        <label><input type="radio" name="status" id="active_status" value="A" <?php echo ($details[0]["status"] == 'A') ? 'checked' : ''; ?>  />Active</label> &nbsp; 
                        <label><input type="radio" name="status" value="I" <?php echo ($details[0]["status"] == 'I') ? 'checked' : ''; ?>  />Inactive</label>
                    <?php } else { ?>
                        <label><input type="radio" name="status" id="active_status" value="A"  checked  />Active</label> &nbsp; <label><input type="radio" name="status" value="I"  />Inactive</label>
                    <?php } ?>
                </td>
            </tr>
             
            <tr><td>
                
                <!-- <input type="file" name="file" value="<?php echo stripslashes($details[0]["phone"]); ?>"> -->
                <!-- <input type="submit" name="subFile" value="Upload"> -->
     
            </td></tr>

            <tr>
                <td></td>
                <td> <input type="button" onclick="put_data()" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_members.php';" value="back to lists" /> </td>
            </tr> 
        </table>
    
    </form>

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">     
         var org_id = '<?php echo $_SESSION['Admin_org_id']; ?>';
         var page = 'members';
         var mem_id = '<?php echo $_GET['edit']; ?>';

       $(document).ready(function(){
           if ( mem_id != '' ){
            $.ajax({
            method: "get", 
            url: "get_data.php",
            data: {org_id: org_id,
            page:page,
            mem_id : mem_id
            }
            }).done(function(data){
                var result= $.parseJSON(data); 
                $.each( result, function( key, value ) {
                $("#mem_name").val(value['name']);
                $("#mem_bio").val(value['mem_bio']);
                $("#mem_email").val(value['email']);
                $("#mem_phone").val(value['phone']);
                $("#meta_keywords").val(value['meta_keywords']);
                $("#status").val(value['meta_keywords']);
                 });
                });
        }

         });

    </script>

    <script type="text/javascript"> 
        function put_data(){
            // include id
         var org_id = '<?php echo $_SESSION['Admin_org_id']; ?>';
         var page = 'members';
        var mem_id = '<?php echo $_GET['edit']; ?>';

        var mem_name = document.getElementById("mem_name").value;
        var mem_bio = document.getElementById("mem_bio").value;
        var mem_email = document.getElementById("mem_email").value;
        var mem_phone = document.getElementById("mem_phone").value;
        var meta_keywords = document.getElementById("meta_keywords").value;

        if (document.getElementById("active_status").checked){
                 var active_status = 'A';
             }else{
                 var active_status = 'I';
             }
       

        if (mem_name == '' || mem_bio == '') {
        alert("Please Fill All Fields");
        } else {
        // AJAX code to submit form.
        $.ajax({
        type: "POST",
        url: "put_data.php",
        data: {
            page : page,
            org_id : org_id,
            mem_id : mem_id,
            name : mem_name,
            mem_bio : mem_bio,
            email : mem_email,
            phone : mem_phone,
            meta_keywords : meta_keywords,
            status : active_status
        },
        cache: false,
        success: function(html) {
        alert(html);
        }
        });
        }
        return false;
        }
    
    </script>


<?php
    include("footer.php");
?>
