 <?php
	include_once  "../constants.php";
	session_start();
	echo "<h3><center>Welcome to the club, ".$_SESSION['user_first_name']." ".$_SESSION['user_last_name']."</center></h3>";
	if(!isset($_SESSION['user_email_address']))
	{
		header('location:'.BASE_URL.'');
	}
?>
 
 <div>
	<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
				<li id="slider11" style="background-image: url(upload/img_bg_4.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center slider-text">
								<div id="slider1Text" class="slider-text-inner">
										</div>
							</div>
						</div>
					</div>
				</li>
				</ul>
			</div>
		</aside>

</div>
    
    <div id="blog">
    
    </div>


        
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var url = '<?php echo GET_DATA_URL ?>' ;
       var org_id = '<?php echo ORG ?>';
       var blog_id = '<?php echo $_GET["blog_id"] ?>';
       var photo1 = '';
        
       function setblogs(){ 
        var page = 'blogs';
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {org_id: org_id ,
           page:page ,
           blog_id:blog_id
           }

         }).done(function( data ) { 

           var result= $.parseJSON(data); 
           var string = '';
           var photo1 = '';  
           var slider1 = document.getElementById('slider1');
            
          /* from result create a string of data and append to the div */
           $.each( result, function( key, value ) { 
              var status =  value['status'];
               if (status == "A"){
                   status = "Active";

            string += "<div class='col-md-10 animate-box' style='padding-left: 200px'>\
            <div>";
						
              
            string +=
					    "<br>\
						<div >\
							<h3><a href='blog_details.php?blog_id="+value['blog_id']+"'>"+ value['blog_title'] + "</a></h3>";
            if (value['date']!="")      string += "<br><span>Date : "+value['date']+"</span>";
							string += "<br>\
							<p>"+ value['blog_data'] + "</p>";

			string +=		"</div>\
				</div>\
                </div>";
              } else{
                   status ="Inactive";
               }

               photo1 += "url(" + value['photo'] + ")";
               console.log(photo1);
                       }); 

            // //   }

                 string += '</div>\
                 </div>\
                 </div>'; 

               $("#blog").html(string); 
            // console.log("setting photo");
            document.getElementById("slider11").style.backgroundImage = photo1;
            // console.log(slider1);
          }); 
   }


  
  
  $.ajax({
   url:setblogs(),
   success:function(){
   setfooter();
}
})


   </script>

