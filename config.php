
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "browser";
$conn = mysqli_connect($hostname,$username,$password,$database);
if(!$conn){
	die("connection failed ".mysql_connect_error());
}
?>