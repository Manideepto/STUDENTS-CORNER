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
<div id="fh5co-staff">

<div class="row">

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var url = '<?php echo GET_DATA_URL ?>' ;
       var org_id = '<?php echo ORG ?>';
       var page = 'members';
 
       function setmembers(){ 

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


             
               string += "<div class='col-md-3 text-center'>\
               <div class='staff'> \
						<div class='staff-img' style='background-image: url(" + value['photo'] + ");'>"+
							"<ul class='fh5co-social'>"+
								// "<li><a href='#'><i class='icon-facebook2'></i></a></li>\
								// <li><a href='#'><i class='icon-twitter2'></i></a></li>\
								// <li><a href='#'><i class='icon-linkedin2'></i></a></li>\
								"<li><a href='mailto:"+ value['email'] +"'><i class='icon-mail5'></i></a></li>\
							</ul>\
							</div>";
      							      // <span>Position</span>\
               string+= "<h3><a href='#'>" + value['name'] + "</a></h3>\
				<p>"+value['mem_bio'].substring(0,80)+ "</p>\
					</div>\
                    </div>";
                  } else{
                   status ="Inactive";
               }

                      }); 

                 string += '</div>\
                 </div>\
                 </div>'; 

             $("#fh5co-staff").html(string); 
          }); 
   }



$.ajax({
   url:setmembers(),
   success:function(){
   setfooter();
}
})

   </script>

