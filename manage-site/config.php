<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
/* for login */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'simple-website');
 
/*for data Collection*/
// define('DATA_DB_NAME', 'formDB');

/* Attempt to connect to MySQL database */
/* for login */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


/*for data Collection*/
// $link2 = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// // Check connection
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }



?>