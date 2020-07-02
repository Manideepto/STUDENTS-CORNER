<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */
session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: home.php");
		exit;
    }
    
require("../libs/config.php");

include("header.php");

if(isset($_GET["name"]) && $_GET["name"])
	$_SESSION["name"]=$_GET["name"];

if(isset($_POST["name"]) && $_POST["name"])
	$_SESSION["name"]=$_POST["name"];

if(isset($_GET["email_event"]) && $_GET["email_event"])
	$_SESSION["email_event"]=$_GET["email_event"];

if(isset($_POST["email_event"]) && $_POST["email_event"])
	$_SESSION["email_event"]=$_POST["email_event"];

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Send email to interested students</title>
<link href="css/style.css" rel="stylesheet" type="text/css"/>
<meta name="robots" content="noindex, nofollow">
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-43981329-1']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script');
ga.type = 'text/javascript';
ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
})();
</script>


<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

textarea, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

span{
    vertical-align:middle;
    text-align:center;
}
</style>

<?php echo "<span><h2>Event: ".$_SESSION['name']."</h2></span>";?>
</head>
<body>
<div id="main">
<span><h1>Send email to interested students</h1></span>
<div id="login">
<hr/>
<form action="send_email.php" method="post">
<br><br><h3>Enter login information of your admin gmail account to send mails</h3>
<input type="text" placeholder="Enter your email ID" name="email"/>
<input type="password" placeholder="Password" name="password"/><br><br><br>
<input type="hidden" value="<?php echo $_SESSION["email_event"];?>" name="email_event"/>
<input type="hidden" value="<?php echo $_SESSION["name"];?>" name="name"/>
<h3>Mail details</h3>
<input type="text" placeholder="Subject : " name="subject"/><br>
<input type="text" placeholder="CC List separated by comma : " name="cc_list"/><br>
<textarea rows="4" cols="50" placeholder="Enter Your Message..." name="message"></textarea><br>
<input type="submit" value="Send" name="send"/>
</form>
</div>
</div>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

if(isset($_POST['send']))
{	
	try {
        $stmt = $DB->prepare("SELECT * FROM mp_interested WHERE `event_id` = :eid AND `org_id` = :oid");
        $stmt->bindValue(":eid", intval(db_prepare_input($_POST['email_event'])));
		$stmt->bindValue(":oid", db_prepare_input($_SESSION['org_id']));
        $stmt->execute();
        $to_ids = $stmt->fetchAll();		
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$message = $_POST['message'];
	$subject = $_POST['subject'];
	$cc_list = explode (",",$_POST['cc_list']);
	$mail = new PHPMailer;
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	//$mail->SMTPDebug = 4;
	$mail->Port = 587;
	$mail->SMTPSecure = 'tls';
	$mail->SMTPAuth = true;
	$mail->Username = $email;
	$mail->Password = $password;
	$mail->setFrom($email);
	foreach($cc_list as $cc_id){
		$mail->addCC($cc_id);
	}
	foreach($to_ids as $to_id){
		$mail->addBCC($to_id['interested_email']);
	}
	$mail->Subject = $subject;
	$mail->msgHTML($message);
	if (!$mail->send()) {
	$error = "Mailer Error: " . $mail->ErrorInfo;
	echo '<p id="para">'.$error.'</p>';
	}
	else {
	echo '<p id="para">Message sent!</p>';
	}
}
?>
</body>
</html>

<?php
include("footer.php");
?>

