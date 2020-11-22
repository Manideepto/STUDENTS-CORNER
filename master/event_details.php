<?php
include_once  "../constants.php";
// if(!isset($_SESSION['user_email_address']))
// {
// 	header('location:'.BASE_URL.'/master/interest?org_id=&event_id=&club_login=false&url=https://'.$_SERVER[HTTP_HOST].''.$_SERVER[REQUEST_URI].'');
// }

// if (isset($_GET["event_id"]) && $_GET["event_id"] != "") {
    
//     //populate
// }

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
       var event_id = '<?php echo $_GET["event_id"] ?>';
	   var user_id = '<?php echo $_SESSION["user_email_address"] ?>';
	   
       function setevents(){ 
        var page = 'events';
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {org_id: org_id ,
           page:page ,
           event_id:event_id
           }

         }).done(function( data ) { 

           var result= $.parseJSON(data); 
           var string = '';
   
          /* from result create a string of data and append to the div */
           $.each( result, function( key, value ) { 
              var status =  value['status'];
               if (status == 'A'){
                   status = "Active";

            string += "<div class='col-md-12 animate-box'>\
            <div class='course'>\
						<a href='event_details.php?event_id="+value['event_id']+"' class='course-img' style='background-image: url(" + value['event_thumbnail'] + ");'>"+
					    "</a>\
					    <br>\
						<div class='desc'>\
							<h3><a href='event_details.php?event_id="+value['event_id']+"'>"+ value['event_title'] + "</a></h3>\
							<br>\
							<p>"+ value['event_desc'] + "</p>";

			if (value['event_format']!="")			string +=	"<br><span>Format : "+value['event_format']+"</span>"
			if (value['event_email']!="")			string +=	"<br><br><span>Email : "+value['event_email']+"</span>"
			if (value['event_phone']!="")			string +=	"<br><span>Phone : "+value['event_phone']+"</span>";
			if (value['event_addDetails']!="")		string +=	"<br><span>Details  : "+value['event_addDetails']+"</span>";
			if (value['event_reglink']!="")			string +=	"<br><span><a id='reg_link' style='display:none' href='"+value['event_reglink']+"' class='btn btn-primary btn-sm btn-course'>Register</a></span>";
			if (value['event_Forumlink']!="")			string +=	"<br><span><a id='forum_link' style='display:none' href='"+value['event_forumlink']+"' class='btn btn-primary btn-sm btn-course'>IIMA Forums</a></span>";
			
			string +=	"<br><span><a id='interested_button' onclick=window.open('../master/interest?event_id="+value['event_id']+"&org_id="+value['org_id']+"','mywindow',menubar=1,resizable=1);check_reglink(); class='btn btn-primary btn-sm btn-course'>Add to Interest  <i class='icon-star2'></a></span>"
            string +=		"</div>\
				</div>\
                </div>";
              } else{
                   status ="Inactive";  
               }
                       }); 

            // //   }
            if(string =="") string +="<h1> Login to view the Event </h1>";

                 string += '</div>\
                 </div>\
                 </div>'; 
                 string = string.replace(/\\/g, "");
                 
              $("#fh5co-course").html(string); 
          });
		
		
   }
	
	function display_reglink() {
		var page = 'reg_link';
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {org_id: org_id ,
           page:page ,
           event_id:event_id,
		   user_id:user_id
           }
        }).done(function( data ) {
		   var result= $.parseJSON(data);
		   var i=0;
		   var x = document.getElementById("reg_link");
           var y = document.getElementById("forum_link");
           var y = document.getElementById("forum_link");           
           var z = document.getElementById("interested_button");

           $.each( result, function( key, value ) {
				i++;
				if (x.style.display === "none") {
					x.style.display = "inline-block";
					y.style.display = "inline-block";
                    z.innerHTML = "Interested <i class='icon-star3'>";

                    // <li><a id="footer_instagram" href="#"><i class="icon-star3"></i></a></li>		
        }
            });
			if(x.style.display === "inline-block" && i==0) {
				x.style.display = "none";
				y.style.display = "none";
                z.innerHTML = "Add to Interest  <i class='icon-star2'>";

      }
 
       });
	 }
	
	
	function check_reglink(){
		var setInt = setInterval(display_reglink, 2000);
		setInterval(function(){
			var x = document.getElementById("reg_link");

			var prev_display = x.style.display;
			setTimeout(function(){
				var curr_display = x.style.display;
				if(prev_display !== curr_display)
					clearInterval(setInt);
			},1000);
			setTimeout(function(){
				clearInterval(setInt);
			},60000);
				
		}
		, 2000);
	}
	
  
  
  $.ajax({
   url:setevents(),
   success:function(){
   display_reglink();
   setfooter();
}
})


   </script>
