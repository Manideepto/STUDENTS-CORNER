<?php
	include_once  "../constants.php";
	if(!isset($_SESSION['user_email_address']))
	{
		header('location:'.BASE_URL.'/master/interest?org_id=&event_id=&club_login=false&url=https://'.$_SERVER[HTTP_HOST].''.$_SERVER[REQUEST_URI].'');
	}
?>

<div id="fh5co-blog">

</div>

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
           var string = '<div class="container">\
           <div class="row">';
   
          /* from result create a string of data and append to the div */
 
          
	       $.each( result, function( key, value ) { 
			string += '<div class="col-lg-4 col-md-4">\
					<div class="fh5co-blog animate-box">';
						string += "<a href='blog_details.php?blog_id="+value['blog_id']+ " ' class='blog-img-holder' style='background-image: url("+value['photo'] + ");'>"+
					    "</a>";
            string += '<div class="blog-text">\
							<h3><a href="blog_details.php?blog_id='+value['blog_id'] + ' ">' + value['blog_title']  + '</a></h3>\
							<span class="posted_on">' +value["date"] + '</span>\
							<p>' + value["blog_data"].substring(0,255).replace( /(<([^>]+)>)/ig, '') + '</p>\
              <span><a class="btn btn-primary btn-sm btn-course" href="blog_details.php?blog_id= '+ value['blog_id'] + '"> Read</a></span>\
            </div> \
					</div>\
				</div>';
          


      //       <div class='course'>\
      //       <br>\
      //       <div class='desc'>\
      //         <h3><a href='blog_details.php?blog_id="+value['blog_id']+"'>"+ value['blog_title'] + "</a></h3>\
      //         <br>\
      //         <p>"+ value['blog_data'].substring(0,80).replace( /(<([^>]+)>)/ig, '') + "</p>";
      // string +=   "</div>\
      //           </div>\
      //           </div>";
            
				}); 
			 
       string += '</div></div>';

      //  string = string.replace(/upload/g,'upload/');

       $("#fh5co-blog").html(string);
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
