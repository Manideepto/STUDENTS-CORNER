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

<div id="member_records"> <div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var org_id = '<?php echo $_SESSION['org_id']; ?>';
       var page = 'members';
       var page_id = '';
       $(function(){ 

         $.ajax({ 
           method: "get", 
           url: "get_data.php",
           data: {org_id: org_id ,
           page:page
           }

         }).done(function( data ) { 

           var result= $.parseJSON(data); 
           var string = '<table class="bordered"> \
           <tr><th ><strong>Name</strong> </th> \
           <th ><strong>Member bio</strong> </th> \
           <th ><strong>Email</strong> </th>\
           <th ><strong>Phone</strong> </th>\
           <th><strong>Status</strong> </th>\
           <th><strong>Action</strong> </th></tr>';
   
          /* from result create a string of data and append to the div */
        
           $.each( result, function( key, value ) { 

               var status =  value['status'];
               if (status == 'A'){
                   status = "Active";
               } else{
                   status ="Inactive";
               }

               string += "<tr> <td>"+value['name'] + "</td><td>"+value['mem_bio']+ "</td><td>" +value['email']+'</td>  \
                       <td>'+value['phone']+"</td><td>"+ status+"</td> <td><a href='add_edit_member.php?edit="+value['mem_id']+"'>Edit</a> | \
                       <a href='upload_photo.php?id="+value['mem_id']+"&org_id="+value['org_id']+"&page=members&name="+value['name']+"'>Photo</a> | \
                       <a href='manage_members.php?del="+value['mem_id']+"'>Delete</a></td></tr>"  ;                   
                 }); 

                 string += '</table>'; 

             $("#member_records").html(string); 
          }); 
   }); 
   </script> 





<?php
include("footer.php");
?>