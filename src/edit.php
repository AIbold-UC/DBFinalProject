<?php
require "database.php";
require "session_auth.php";

$PID = $_GET["pid"];
$row= getproductinfo($PID);
			$stock = $row["stock"];
			$price =$row["price"];
			$name= $row["name"];
			$type= $row["type"];

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
	<br>
	<form method="post">
	<input type="hidden" name="pid" value="<?php echo $PID; ?>">
	

    Quantity:
    <input type="text" name="name" value="<?php echo $name; ?>"> <br>
    <input type="number" name="price" min="0" step="0.01" value="<?php echo $price; ?>"><br>
     <input type="number" name="stock" min="0" value="<?php echo $stock; ?>"><br>

    <input type="text" name="type" value="<?php echo $type; ?>"><br>

    <input type="submit" name="edit" value="Edit"><br>
	</form>
<?php
	if (isset($_POST["edit"])) {
    $PID = $_POST["pid"];
    $stock = $_POST["stock"];
    $name =$_POST['name'];
    $price=$_POST['price'];
    $type=$_POST['type'];

    updateproductinfo($PID, $name,$price,$stock,$type);
	}
?>


</body>
</html>