<?php
require "database.php";
require "session_auth.php";

$PID = $_GET["pid"];
$name = $_GET["name"];
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
	<title> EComPurchase</title>
</head>
<body>
	<h3> How many <?php echo($name)?>s do you want? </h3>
	<br>
	<form method="post">
	<input type="hidden" name="pid" value="<?php echo $PID; ?>">
	<input type="hidden" name="name" value="<?php echo $name; ?>">

    Quantity:
    <input type="number" name="quantity" min="1" value="1">

    <input type="submit" name="purchase" value="Purchase">
	</form>



	<?php
	if (isset($_POST["purchase"])) {
    $PID = $_POST["pid"];
    $quantity = $_POST["quantity"];

    makepurchase($PID, $quantity);
	}
?>
</body>
</html>