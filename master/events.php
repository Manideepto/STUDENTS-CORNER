<?php
	include_once  "../constants.php";
	if(!isset($_SESSION['user_email_address']))
	{
		header('location:'.BASE_URL.'/master/interest?org_id=&event_id=&club_login=false&url=https://'.$_SERVER[HTTP_HOST].''.$_SERVER[REQUEST_URI].'');
	}

?>

<div class="container">
<div id="fh5co-course">

    <div class="row">

        <!-- <div class='col-md-6 animate-box'> 		 -->
                        <!-- <div class='course'>
						<a href='#' class='course-img' style='background-image: url(images/project-1.jpg);'>
						</a>
						<div class='desc'>
							<h3><a href='#'>Web Master</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamust ab aliquam dolor eius.</p>
							<span><a href='#' class='btn btn-primary btn-sm btn-course'>Take A Course</a></span>
						</div>
					</div> -->
        <!-- </div>     -->
        

        
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var url = '<?php echo GET_DATA_URL ?>' ;
       var org_id = '<?php echo ORG ?>';
       
 
       function setevents(){ 
        var page = 'events';
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
          
              var status =  value['status'];
               if (status == 'A'){
                   status = "Active";

            string += "<div class='col-md-6 animate-box'>\
            <div class='course'>\
						<a href='event_details.php?event_id="+value['event_id']+"' class='course-img' style='background-image: url(" + value['event_thumbnail'] + ");'>"+
					    "</a>\
						<div class='desc'>\
							<h3><a href='event_details.php?event_id="+value['event_id']+"'>"+ value['event_title'] + "</a></h3>\
							<p>"+ value['event_desc'].substring(0,80) + "</p>\
							<span><a href='event_details.php?event_id="+value['event_id']+"' class='btn btn-primary btn-sm btn-course'>More Details</a></span>\
						</div>\
				</div>\
                </div>";
              } else{
                   status ="Inactive";
               }
                       }); 

            // //   }

            if(string =="") string +="<h1> Login to view private Events </h1>";

                 string += '</div>\
                 </div>\
                 </div>'; 

              $("#fh5co-course").html(string); 
          }); 
   }


  
  
  $.ajax({
   url:setevents(),
   success:function(){
   setfooter();
}
})


   </script>

