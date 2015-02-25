<?php include('Connections/connect.php'); ?>
<?php

session_start(); // Starting Session
$error=''; // Variable To Store Error Message


// Define $username and $password
$username=$_GET['name'];
$password=$_GET['password'];


// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);


// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "root", "root");


// Selecting Database
//$db = mysql_select_db("dbshop", $connection);


// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from tbladmin where strPassword='$password' AND strEmail='$username'", $connect)or
      die(mysql_error($connect));
$rows = mysql_num_rows($query);
if ($rows == 1) {
//setcookie("error","Username or Password is invalid",time()-1000,"/");
$_SESSION['usuario']=$username; // Initializing Session
$_SESSION['clave']=$password; // Initializing Session
header("location: mareas_lista.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
setcookie("error","Username or Password is invalid!",time()+60*5,"/");
header("location: index.php"); // Redirecting To Other Page
}
mysql_close($connection); // Closing Connection


?>