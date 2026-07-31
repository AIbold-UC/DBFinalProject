<?php
require "database.php";
require "session_auth.php";

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
	<title> EComEdit</title>
</head>
<body>

	<?php
	totalpurchases();
?>
</body>
</html>