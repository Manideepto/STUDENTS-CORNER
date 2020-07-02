<?php
	include_once  "../constants.php";
	session_start();
	echo "<h3><center>Welcome to the club, ".$_SESSION['user_first_name']." ".$_SESSION['user_last_name']."</center></h3>";
	if(!isset($_SESSION['user_email_address']))
	{
		header('location:'.BASE_URL.'');
	}
?>

<div class="container">
<div id="fh5co-course">
 
    <div class="row">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var url = '<?php echo GET_DATA_URL ?>' ;
       var org_id = '<?php echo ORG ?>';
       var page = 'blogs';
 
       function setblog(){ 
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {org_id: org_id ,
           page:page
           }
         }).done(function( data ) { 
           var result= $.parseJSON(data); 
           var string = '';
   
          /* from result create a string of data and append to the div */
 
		  
	       $.each( result, function( key, value ) { 
			string += "<div class='col-md-6 animate-box'>\
            <div class='course'>\
            <br>\
            <div class='desc'>\
              <h3><a href='blog_details.php?blog_id="+value['blog_id']+"'>"+ value['blog_title'] + "</a></h3>\
              <br>\
              <p>"+ value['blog_data'].substring(0,80) + "</p>";
      string +=   "</div>\
                </div>\
                </div>";
            
				}); 
			 
       $("#fh5co-course").html(string);
              // document.getElementById('tagline1').innerHTML = string; 
			//   document.getElementById('backgroundimage1').style= "background-image: url(images/img_bg_1.jpg)";
   
          }); 
   } 

   $.ajax({
	url:setblog(),
	success:function(){
	setfooter();
	}
	})


   </script>
