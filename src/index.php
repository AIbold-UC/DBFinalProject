<?php
	require "database.php";
	session_set_cookie_params(15*60,"/","",TRUE,TRUE);
	




	session_start();
	$name=$_POST["name"];
	$password=$_POST["password"];
	if(isset($_POST["name"]) and isset($_POST["password"])){
		if (checklogin_customer($_POST["name"],$_POST["password"])) {
			$_SESSION['authenticated']=TRUE;
			$_SESSION['name']=$_POST['name'];
			$_SESSION['browser']=$_SERVER['HTTP_USER_AGENT'];
			

	
	
		}else{
			session_destroy();
			echo"<script>alert('Invalid name/password');window.location='form.php';</script>";
			die();
		}
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
	<style>
	body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}

	</style>
	<title> EComProducts</title>
</head>
<body>
	<h1>Products:</h1>
	<br>
	<?php
	getproducts();
?>
</body>