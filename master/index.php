<?php
	include_once  "../constants.php";
	//require("../libs/config.php");
	if(!isset($_SESSION['user_email_address']))
	{
		header('location:'.BASE_URL.'');
	}
	
	//Query for Events
	/*$sql = "SELECT event_id,event_title,event_thumbnail FROM mp_events WHERE org_id = '" .$_SESSION['org_id']. "'AND status='A' ORDER BY event_date,count_interested ASC";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll();
	$i=0;
	echo "<div class='navbar'>";
	foreach($results as $row) {
		if($i==2)
			break;
		echo "<a target='_blank' href='event_details.php?event_id=".$row['event_id']."'><img src='".$row['event_thumbnail']."' style='width:100px'><br>".$row['event_title']."</a>";
		$i++;
	}
	
	//Query for Blogs
	$sql = "SELECT blog_id,blog_title,photo FROM mp_blogs WHERE org_id = '" .$_SESSION['org_id']. "'AND status='A' ORDER BY date ASC";
	$stmt = $DB->prepare($sql);
	$stmt->execute();
	$results = $stmt->fetchAll();
	$i=0;
	foreach($results as $row) {
		if($i==2)
			break;
		echo "<a target='_blank' href='blog_details.php?blog_id=".$row['blog_id']."'><img src='".$row['photo']."' style='width:100px'><br>".$row['blog_title']."</a>";
		$i++;
	}
	echo "</div>";*/
	
?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	* {
	  box-sizing: border-box;
	}

	/* Create three equal columns that floats next to each other */
	.column {
	  float: left;
	  width: 25%;
	  padding: 10px;
	  height: 200px; /* Should be removed. Only for demonstration */
	}

	/* Clear floats after the columns */
	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}
	</style>
	
	<div class="row">
	<div class="column" style="background-color:#dddd;">
		<h2 style="text-align:right"><u>Upcoming</u></h2>
		<center><p id="upcoming_event1"></p></center>
	 </div>
	 <div class="column" style="background-color:#cccc;" >
		<h2><u>Events</u></h2>
		<center><p id="upcoming_event2"></p></center>
	 </div>
	 <div class="column" style="background-color:#eedf;">
		<h2 style="text-align:right"><u>Recent</u></h2>
		<center><p id="recent_blog1"></p></center>
	 </div>
	 <div class="column" style="background-color:#ddcf;" >
		<h2><u>Blogs</u></h2>
		<center><p id="recent_blog2"></p></center>
	 </div>
	 </div>
	
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
			var string = '';
			var i=0;
			$.each( result, function( key, value ) {
				i++;
				string = "<a target='_blank' href='event_details.php?event_id="+value['event_id']+"'><img src='"+value['event_thumbnail']+"' style='width:100px'>"+value['event_title']+"</a>";
				if(i==1)
					$("#upcoming_event1").html(string);
				else if(i==2)
					$("#upcoming_event2").html(string);
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
			var string = '';
			var i=0;
			$.each( result, function( key, value ) {
				i++;
				string = "<a target='_blank' href='blog_details.php?blog_id="+value['blog_id']+"'><img src='"+value['photo']+"' style='width:100px'>"+value['blog_title']+"</a>";
				if(i==1)
					$("#recent_blog1").html(string);
				else if(i==2)
					$("#recent_blog2").html(string);
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

