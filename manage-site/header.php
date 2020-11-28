<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <!-- <link rel="icon" href="http://thesoftwareguy.in/favicon.ico" type="image/x-icon" /> -->
<title>Admin Area</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<body>
<div id="container" >
    <div id="body">
        <header>
            <div class="mainTitle" ><?php echo $pageTitle; ?></div>
        </header>
        <nav>
        <!-- <a href="home.php" class="menus">Home</a> -->
        <a href="main.php" class="menus">Site Details</a>
        <!-- <a href="manage_pages.php" class="menus" >Manage Pages</a> -->
        <a href="manage_blog.php" class="menus" >Manage Blog</a>
        <a href="manage_events.php"class="menus" >Manage Events</a>
        <a href="manage_members.php" class="menus" >Manage Members</a>
        <a href="reset-password.php" class="menus" >Reset Password</a>
        <a href="logout.php"  class="menus"  >Logout</a>
        
<!-- 
        <div class="container-login100-form2-btn">
						<button class="login100-form2-btn" onclick = "window.location.href='reset-password.php'">
							Reset Password
						</button>
					</div>

                    <div class="container-login100-form2-btn">
						<button class="login100-form2-btn" onclick = "window.location.href='logout.php'" >
							Sign Out
						</button>
					</div> -->
        </nav>

        <article>
