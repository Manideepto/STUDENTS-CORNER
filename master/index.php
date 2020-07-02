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
			var page = 'main';
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

