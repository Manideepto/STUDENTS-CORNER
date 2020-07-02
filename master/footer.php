    </article>
		<div class="height30"></div>
	
		<footer id="fh5co-footer" role="contentinfo" style="background-image: url(images/img_bg_4.jpg);">
	   <div class="overlay"></div>

	   <div class="container">
			<div class="row row-pb-md">
				<div class="col-md-8 fh5co-widget">
					<h3>About US</h3>
					<!-- <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget"> -->
					<div class="fh5co-contact-info col-md-5">
						<ul>
							<p id="about_us">we dsgngaodsag dfaojgndsag naongdsaog naodgndsoafds akndsjgbsdajgb dsjkagbsk</p>
						</ul>
					</div>
				</div> 


				<div class="col-md-3 fh5co-widget">
					<h3>Contact Information</h3>
					<!-- <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget"> -->
					<div class="fh5co-contact-info">
						<ul>
							<li class="address" id="address">Indian Instiute of Management<br>Ahmedabad</li>
							<!-- <li class="phone" id="phone"><a href="tel://1234567920">+ 1235 2355 98</a></li> -->
							<li class="email" id="footer_email"><a href="mailto:info@yoursite.com">info@yoursite.com</a></li>
						</ul>
					</div>
				</div> 
					<!-- </div> -->

					<!-- <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 fh5co-widget"> -->
	
				<div class="col-md-1 fh5co-widget">
						<h3>follow</h3>

					<div class="fh5co-contact-info">
						<ul class="fh5co-social">
							<!-- <li class="linkedin" id="footer_linkedin" ><a href="mailto:info@yoursite.com">Linkedin</a></li>
							<li class="facebook" id="footer_facebook"><a href="mailto:info@yoursite.com">Facebook</a></li>
							<li class="instagram" id="footer_instagram"><a href="mailto:info@yoursite.com">Twitter</a></li>
							 -->
							<li><a id="footer_facebook" href="#"><i class="icon-facebook2"></i></a></li>
							<li><a id="footer_linkedin" href="#"><i class="icon-linkedin2"></i></a></li>
							<li><a id="footer_instagram" href="#"><i class="icon-instagram"></i></a></li>
						</ul>
					</div>
				</div>

		

				</div>
					
             	</div>
        		 
			</div>
		</div>

             
		
			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2019. All Rights Reserved.</small> 
						<small class="block">Powered by <a href="http://stdwww.iima.ac.in/ccc/" target="_blank">CCC IIMA</a> </small>
					</p>
				</div>
			</div>
		</div>
	</footer>
   
</div>




<script type="text/javascript"> 
   function setfooter(){
// console.log("Hello");
	var url = '<?php echo GET_DATA_URL ?>' ;
    var org_id = '<?php echo ORG ?>';
	var page = 'main';
$.ajax({ 
    method: "get", 
    url: url ,
    data: {org_id: org_id ,
    page:page
    }

  }).done(function( data ) { 

    var result= $.parseJSON(data); 
    var facebook_string = '';
	var email_string = '';
	var linkedin_string = '';
	var instagram_string = '';
	var logo_string = '';
	var org_name_string = '';
	var aboutus_string = '';

   /* from result create a string of data and append to the div */


  $.each( result, function( key, value ) { 

email_string += '<a href="mailto:' + value['email'] + '">' + value['email'] + '</a>'
// facebook_string += '<a href="' + value['facebookLink'] + '">' + value['facebookLink'] + '</a>'
// linkedin_string += '<a href="' + value['linkedinLink'] + '">' + value['linkedinLink'] + '</a>'
// instagram_string += '<a href="' + value['instagramLink'] + '">' + value['instagramLink'] + '</a>'
org_name_title_string = org_name_string = value['org_name'];
	
facebook_string +=value['facebookLink'];
instagram_string +=value['instagramLink'];
linkedin_string +=value['linkedinLink'];
aboutus_string +=value['about'];
// console.log(aboutus_string);
if ( value['logo'] == null){
	logo_string += 'upload/iimlogo.png'
}else{
	logo_string += value['logo']
 }

}); 

   $("#footer_email").html(email_string); 
//    $("#footer_facebook").html(facebook_string); 
//    $("#footer_linkedin").html(linkedin_string); 
//    $("#footer_instagram").html(instagram_string); 
   $("#org_name").html(org_name_string);
   $("#org_name_title").html(org_name_string);
   $("#about_us").html(aboutus_string); 
   document.getElementById("logo").src= logo_string;
   document.getElementById("footer_facebook").href = facebook_string;
   document.getElementById("footer_instagram").href = instagram_string;
   document.getElementById("footer_linkedin").href = linkedin_string;
   }); 
} 

</script>

   <script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Count Down -->
	<script src="js/simplyCountdown.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

</body>
</html>



