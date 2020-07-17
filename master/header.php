<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
 include_once  "../constants.php";
 session_start();
 if(!isset($_SESSION['user_email_address']))
 {
	header('location:'.BASE_URL.'');
 } 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<title id="org_name_title">ORG1</title>

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="../css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="../css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>

	

	<link rel="icon" href="upload/iimlogo.png">
	
</head>

<body>

<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<!-- <div class="top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-right">
						<p class="site">www.yourdomainname.com</p>
						<p class="num">Call: +01 123 456 7890</p>
						<ul class="fh5co-social">
							<li><a href="#"><i class="icon-facebook2"></i></a></li>
							<li><a href="#"><i class="icon-twitter2"></i></a></li>
							<li><a href="#"><i class="icon-dribbble2"></i></a></li>
							<li><a href="#"><i class="icon-github"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div> -->
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-xs-8">
						<div id="fh5co-logo">
							<img id="logo" src="upload/iimlogo.png" alt="logo" width="60">	
							<a href="index.php">
							<span id="org_name">org</span>
						</a>
						</div>
					</div>
					
					<div class="col-xs-4 col-md-4">
					<nav class="navbar navbar-expand-sm navbar-light bg-light">
						  <ul class="navbar-nav">
						    <li class="nav-item dropdown">
							  <a class="navbar-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Home
							  </a>
							  <div class="dropdown-menu navbar-light bg-light" aria-labelledby="navbarDropdown">
							    <a class="dropdown-item" href="index.php">Current Club</a>
							    <a class="dropdown-item" href="../">All Clubs</a>
							  </div>
						    </li>
							<li class="nav-item dropdown">
							  <a class="navbar-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Activities
							  </a>
							  <div class="dropdown-menu navbar-light bg-light" aria-labelledby="navbarDropdown" style="background-color: #e3f2fd;">
							    <a class="dropdown-item" href="events.php">Events</a>
							    <a class="dropdown-item" href="blog.php">Blog</a>
							  </div>
						    </li>
							<li class="nav-item">
							  <a class="navbar-link" href="members.php">Members</a>
							</li>
							<li class="nav-item dropdown">
							  <a class="navbar-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <?php echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" width="50" align="middle"/>';?>
							  </a>
							  <div class="dropdown-menu navbar-light bg-light" aria-labelledby="navbarDropdown" style="background-color: #e3f2fd;">
							    <a class="dropdown-item" href="../master/logout.php"><?php echo "<b>Logout?</b>  ".$_SESSION['user_first_name']." ".$_SESSION['user_last_name'].""; ?> </a>
							  </div>
						    </li>
						  </ul>
					</nav>
					</div>
					
				</div>
				
			</div>
		</div>
    </nav>




    <article>
