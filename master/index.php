<?php
	include_once  "../constants.php";
	//require("../libs/config.php");

	// if(!isset($_SESSION['user_email_address']))
	// {
	// 	header('location:'.BASE_URL.'/master/interest?org_id=&event_id=&club_login=false&url=https://'.$_SERVER[HTTP_HOST].''.$_SERVER[REQUEST_URI].'');
	// }
	
?>
	
	<div>
	<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
				<li id="slider1" style="background-image: url(images/img_bg_1.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center slider-text">
								<div id="slider1Text" class="slider-text-inner">
									<h1>The Roots of Education are Bitter, But the Fruit is Sweet</h1>
										</div>
							</div>
						</div>
					</div>
				</li>
				<li id="slider2" style="background-image: url(images/img_bg_2.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center slider-text">
								<div id="slider2Text" class="slider-text-inner">
									<h1>The Great Aim of Education is not Knowledge, But Action</h1>
										</div>
							</div>
						</div>
					</div>
				</li>
				<li id="slider3" style="background-image: url(images/img_bg_3.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center slider-text">
								<div id="slider3Text" class="slider-text-inner">
									<h1>We Help You to Learn New Things</h1>
										</div>
							</div>
						</div>
					</div>
				</li>
				<li id="slider4" style="background-image: url(images/img_bg_3.jpg);">
					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="row">
							<div class="col-md-8 col-md-offset-2 text-center slider-text">
								<div  id="slider4Text" class="slider-text-inner">
									<h1>We Help You to Learn New Things</h1>
								</div>
							</div>
						</div>
					</div>
				</li>		   	
				</ul>
			</div>
		</aside>

	</div>
	
<?php
	if(!isset($_SESSION['user_email_address']))
	{
		// header('location:'.BASE_URL.'/master/interest?org_id=&event_id=&club_login=false&url=https://'.$_SERVER[HTTP_HOST].''.$_SERVER[REQUEST_URI].'');
    echo '<div align="center">
    <span style="font-size: 40px; color:#000000;  background-color:#e0e0eb; width:100%" >
    Login with IIMA credentitals to view all content</span>
   </div>';
  }
?>

	<div id="fh5co-blog">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2><b>Upcoming Events &amp; Recent Blogs<b></h2>
				</div>
			</div>
			<div class="row row-padded-mb">
				<div class="col-md-6 animate-box">
					<div class="fh5co-event">
						<div class="date text-center" id="recent_event_date1" ><span></span></div>
						<h3><a href="#" id="recent_event_title1" >No more events to show</a></h3>
						<p id="recent_event_desc1" ></p>
						<p><a id="recent_event_details1" href="#"></a></p>

						<!-- <a href="#" class="course-img" id="recent_event_img1" style="background-image: url(images/project-1.jpg);">
						</a>
						<div class="desc">
							<h3><a href="#" id="recent_event_title1"></a></h3>
							<a id="recent_event_desc1"></a><br><br>
							<span><a class="btn btn-primary btn-sm btn-course" id="recent_event_details1">Event Details</a></span>
						</div> -->
					</div>
				</div>
				<div class="col-md-6 animate-box">
					<div class="fh5co-event">
						<div class="date text-center" id="recent_event_date2"><span></span></div>
						<h3><a href="#" id="recent_event_title2" >No more events to show</a></h3>
						<p id="recent_event_desc2" ></p>
						<p><a id="recent_event_details2" href="#"></a></p>

						<!-- <a href="#" class="course-img" id="recent_event_img2" style="background-image: url(images/project-2.jpg);">
						</a>
						<div class="desc">
							<h3><a href="#" id="recent_event_title2"></a></h3>
							<a id="recent_event_desc2"></a><br><br>
							<span><a class="btn btn-primary btn-sm btn-course" id="recent_event_details2">Event Details</a></span>
						</div> -->
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-lg-6 col-md-6">
					<div class="fh5co-blog animate-box">
						<a href="#" class="blog-img-holder" id="recent_blog_img1" style="background-image: url(images/project-1.jpg);"></a>
						<div class="blog-text">
							<h3><a href="#" id="recent_blog_title1"></a></h3>
							<span class="posted_on" id="recent_blog_date1" ></span>
							<a id="recent_blog_desc1">No more blogs to show</a><br><br>
							<span><a class="btn btn-primary btn-sm btn-course" id="recent_blog_details1">Read</a></span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6">
					<div class="fh5co-blog animate-box">
						<a href="#" class="blog-img-holder" id="recent_blog_img2" style="background-image: url(images/project-2.jpg);">
						</a>
						<div class="blog-text">
							<h3><a href="#" id="recent_blog_title2"></a></h3>
							<span class="posted_on" id="recent_blog_date2"></span>
							<a id="recent_blog_desc2">No more blogs to show</a><br><br>
							<span><a class="btn btn-primary btn-sm btn-course" id="recent_blog_details2">Read</a></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	
	<script type="text/javascript"> 
		var url = '<?php echo GET_DATA_URL ?>' ;
		var org_id = '<?php echo ORG ?>';
		function setindex(){
			var page = 'upcoming_events';
			$.ajax({ 
			method: "get", 
			url: url ,
			data: {org_id: org_id ,
			page:page
			}
			}).done(function( data ) { 
			var result= $.parseJSON(data); 
			var recent_event_title1 = document.getElementById('recent_event_title1');
			var recent_event_title2 = document.getElementById('recent_event_title2');
			// var recent_event_img1 = document.getElementById('recent_event_img1');
			// var recent_event_img2 = document.getElementById('recent_event_img2');
			
			var recent_event_details1 = document.getElementById('recent_event_details1');
			var recent_event_details2 = document.getElementById('recent_event_details2');
			
			var mon = new Array();
			mon["01"] = "Jan";
			mon["02"] = "Feb";
			mon["03"] = "Mar";
			mon["04"] = "Apr";
			mon["05"] = "May";
			mon["06"] = "Jun";
			mon["07"] = "Jul";
			mon["08"] = "Aug";
			mon["09"] = "Sep";
			mon["10"] = "Oct";
			mon["11"] = "Nov";
			mon["12"] = "Dec";

			var i=0;
			$.each( result, function( key, value ) {
				i++;
				//string = "<a target='_blank' href='event_details.php?event_id="+value['event_id']+"'><img src='"+value['event_thumbnail']+"' class='img-responsive img-circle img-thumbnail' style='width: 100px; height: 100px;' align='middle'><h4>"+value['event_title']+"</h4></a>";
				if(i==1)
				{

					recent_event_title1.text = value['event_title'];
					recent_event_title1.href="event_details.php?event_id="+value['event_id'];
					$("#recent_event_desc1").html("<p>"+value['event_desc'].substring(0,200)+"</p>");
					$("#recent_event_date1").html("<span>"+value['event_datetime'].substring(8,10)+ "<br>" + mon[value['event_datetime'].substring(5,7)] +"</span>");
					// recent_event_img1.style.backgroundImage =  "url(" + value['event_thumbnail'] + ")";
					// recent_event_img1.href="event_details.php?event_id="+value['event_id'];
					recent_event_details1.href="event_details.php?event_id="+value['event_id'];
				}
				else if(i==2)
				{
					recent_event_title2.text = value['event_title'];
					recent_event_title2.href="event_details.php?event_id="+value['event_id'];
					$("#recent_event_desc2").html("<p>"+value['event_desc'].substring(0,200)+"</p>");
					$("#recent_event_date2").html("<span>"+value['event_date'].substring(8,10)+ "<br>" + mon[value['event_date'].substring(5,7)] +"</span>");
					// recent_event_img2.style.backgroundImage =  "url(" + value['event_thumbnail'] + ")";
					// recent_event_img2.href="event_details.php?event_id="+value['event_id'];
					recent_event_details2.href="event_details.php?event_id="+value['event_id'];
					
				}
			});
			});
			var page = 'recent_blogs';
			$.ajax({ 
			method: "get", 
			url: url ,
			data: {org_id: org_id ,
			page:page
			}
			}).done(function( data ) { 
			var result= $.parseJSON(data);
			var recent_blog_title1 = document.getElementById('recent_blog_title1');
			var recent_blog_title2 = document.getElementById('recent_blog_title2');
			var recent_blog_img1 = document.getElementById('recent_blog_img1');
			var recent_blog_img2 = document.getElementById('recent_blog_img2');
			var recent_blog_details1 = document.getElementById('recent_blog_details1');
			var recent_blog_details2 = document.getElementById('recent_blog_details2');
			var recent_blog_date1 = document.getElementById('recent_blog_date1');
			var recent_blog_date2 = document.getElementById('recent_blog_date2');
			
			var i=0;
			$.each( result, function( key, value ) {
				i++;
				string = "<a target='_blank' href='blog_details.php?blog_id="+value['blog_id']+"'><img src='"+value['photo']+"' class='img-responsive img-circle img-thumbnail' style='width: 100px; height: 100px;' align='middle'><h4>"+value['blog_title']+"</h4></a>";
				if(i==1)
				{
					recent_blog_title1.text = value['blog_title'];
					recent_blog_title1.href="blog_details.php?blog_id="+value['blog_id'];
					$("#recent_blog_desc1").html("<p>"+value['blog_data'].substring(0,200).replace( /(<([^>]+)>)/ig, '')+"</p>");
					$("#recent_blog_date1").html(value['date']);
					recent_blog_img1.style.backgroundImage =  "url(" + value['photo'] + ")";
					recent_blog_img1.href="blog_details.php?blog_id="+value['blog_id'];
					recent_blog_details1.href="blog_details.php?blog_id="+value['blog_id'];
					recent_blog_date1.href="blog_details.php?blog_id="+value['blog_id'];
				
				}
				else if(i==2)
				{
					recent_blog_title2.text = value['blog_title'];
					recent_blog_title2.href="blog_details.php?blog_id="+value['blog_id'];
					$("#recent_blog_desc2").html("<p>"+value['blog_data'].substring(0,200).replace( /(<([^>]+)>)/ig, '')+"</p>");
					$("#recent_blog_date2").html(value['date']);
					recent_blog_img2.style.backgroundImage =  "url(" + value['photo'] + ")";
					recent_blog_img2.href="blog_details.php?blog_id="+value['blog_id']
					recent_blog_details2.href="blog_details.php?blog_id="+value['blog_id']
					recent_blog_date2.href="blog_details.php?blog_id="+value['blog_id']
				
				}
			});
			});
			
			page = 'main';
			$.ajax({ 
			method: "get", 
			url: url ,
			data: {org_id: org_id ,
			page:page
			}

			}).done(function( data ) { 

			var result= $.parseJSON(data); 
			var string1 = '';
			var string2 = '';
			
			var photo1 ='';
			var photo2 ='';
			var photo3 ='';
			var photo4 ='';

			var slider1 = document.getElementById('slider1');
			var slider2 = document.getElementById('slider2');
			var slider3 = document.getElementById('slider3');
			var slider4 = document.getElementById('slider4');

			$.each( result, function( key, value ) { 

				// string += "<h1>test tagline 1<h1>";	
					photo1 += "url(" + value['photo1'] + ")";
					photo2 += "url(" + value['photo2'] + ")";
					photo3 += "url(" + value['photo3'] + ")";
					photo4 += "url(" + value['photo4'] + ")";
					
					string1 += "<h1>"+value['tagline1']+"</h1>";
					string2 += "<h1>"+value['tagline2']+"</h1>";

					}); 
					
					slider1.style.backgroundImage = photo1;
					slider2.style.backgroundImage = photo2;
					slider3.style.backgroundImage = photo3;
					slider4.style.backgroundImage = photo4;
					
					$("#slider1Text").html(string1);
					$("#slider2Text").html(string2);
					$("#slider3Text").html(string1);
					$("#slider4Text").html(string2);
					
			}); 
	} 


	


	$.ajax({
	url:setindex(),
	success:function(){
	setfooter();
	}
	})


	</script>

