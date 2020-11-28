<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */

session_start();
	
	//Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: home.php");
		exit;
	}


require("../libs/config.php");
$pageTitle = "Manage Events";    // to change
$msg = '';

if (isset($_GET["del"]) && $_GET["del"] != "") {
    $sql = "DELETE FROM mp_events WHERE `event_id` = :id";
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
<?php echo $msg;?>
<div class="title" style="text-align:right;"><a href="add_edit_event.php">Add Event</a></div>


<div id="event_records"> <div>
<div>
<p> Pencil icon as a link:
        <a href="#">
          <span class="glyphicon glyphicon-pencil"></span>
        </a>
    </p>    
</div>

    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    
    
    <script type="text/javascript"> 
        var org_id = '<?php echo $_SESSION['Admin_org_id']; ?>';
        var page = 'admin_events';
        var event_id = '';
        $(function(){ 

          $.ajax({ 
            method: "get", 
            url: "get_data.php",
            data: {org_id: org_id,
            page:page
            }

          }).done(function( data ) { 

            var result= $.parseJSON(data); 
            var string = '<table class="bordered"><tr><th ><strong>Event</strong> </th> \
            <th ><strong>Email</strong> </th>\
            <th ><strong>Phone</strong> </th>\
            <th><strong>Status</strong> </th>\
            <th><strong>Action</strong> </th>\
			<th><strong>Count of interested people</strong> </th></tr>';
    
           /* from result create a string of data and append to the div */
         
            $.each( result, function( key, value ) { 

                var status =  value['status'];
                if (status == 'A'){
                    status = "Active";
                } else{
                    status ="Inactive";
                }

                string += "<tr> <td>"+value['event_title'] + "</td><td>" +value['event_email']+'</td>  \
                        <td>'+value['event_phone']+"</td><td>"+ status+"</td> <td>\
                        <a href='add_edit_event.php?edit="+value['event_id']+"'> <span class='glyphicon glyphicon-pencil'></span></a> | \
                        <a href='upload_photo.php?id="+value['event_id']+"&org_id="+value['org_id']+"&page=events&name="+value['event_title']+"'><span class='glyphicon glyphicon-picture'></span></a> | \
                        <a href='manage_events.php?del="+value['event_id']+"'> <span class='glyphicon glyphicon-trash'></span></a> | \
                        <a href='send_email.php?email_event="+value['event_id']+"&name="+value['event_title']+"'>Send mail</a> |\
                        </td> \
                        <td>"+value['count_interested']+" |<a href='interested_events.php?interest_event="+value['event_id']+"&name="+value['event_title']+"'> List</a></td></tr>"  ;                              
                  }); 

                  string += '</table>'; 

              $("#event_records").html(string); 
           }); 
    }); 
    </script> 




<?php
include("footer.php");
?>

