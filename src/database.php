<?php
	$mysqli = new mysqli('localhost',
		'dbuser',
		'userpassword',
		'EComDB');

	if($mysqli->connect_errno){
		printf("Database connection failed: %s\n",
			$mysqli->connect_error);
		exit();
	}




	function checklogin_customer($name, $password) {
		global $mysqli;

		$sql = "SELECT * FROM customers WHERE name=? ";
		$sql = $sql . "AND password=md5(?)";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss",$name,$password);
		$stmt->execute();

		$result = $stmt->get_result();

		if($result->num_rows==1){
			$row = $result->fetch_assoc();

			$_SESSION["name"] = $row["name"];
			$_SESSION["CID"] =$row["CID"];

			return TRUE;
		}

		return FALSE;
	}


	function checklogin_staff($name, $password) {
		global $mysqli;

		$sql = "SELECT * FROM staff WHERE name=? ";
		$sql = $sql . "AND password=md5(?)";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("ss",$name,$password);
		$stmt->execute();

		$result = $stmt->get_result();

		if($result->num_rows==1){
			$row = $result->fetch_assoc();

			$_SESSION["name"] = $row["name"];
			$_SESSION["SID"] =$row["SID"];

			return TRUE;
		}

		return FALSE;
	}


	function totalpurchases(){
		global $mysqli;
		$sql= "SELECT 
			    products.name,
			    SUM(purchases.quantityBought) AS totalQuantitySold,
			    SUM(purchases.totalPrice) AS totalRevenue
			FROM products
			JOIN purchases
			    ON products.PID = purchases.PID
			GROUP BY products.PID, products.name";

			if(!($stmt = $mysqli->prepare($sql))){
			echo "Error in fetching products!";
			die();
		}

		if(!$stmt->execute()){
			return FALSE;
		}



		$name = NULL;
		$quantitySold = NULL;
		$totalPrice = NULL;
		$stmt->bind_result($name,$quantitySold,$totalPrice);

		while($stmt->fetch()){
			echo "| Name: ".htmlentities($name) . "  | number sold: "
				. htmlentities($quantitySold) . "  | Total value sold: "
				. htmlentities($totalPrice) . "  |  " ;

		}



	}


	function getproducts() {
		global $mysqli;

		$sql = "SELECT PID,name,price,stock FROM products";

		if(!($stmt = $mysqli->prepare($sql))){
			echo "Error in fetching products!";
			die();
		}

		$stmt->execute();



		$PID = NULL;
		$name = NULL;
		$price = NULL;
		$stock = NULL;

		$stmt->bind_result($PID,$name,$price,$stock);

		while($stmt->fetch()){
			echo "| Name: ".htmlentities($name) . "  | Price: "
				. htmlentities($price) . "  | Stock Left: "
				. htmlentities($stock) . "  |  " ;

			echo "<a href=\"purchase.php?pid=" . urlencode($PID) . "&name=". urlencode($name). "\">Purchase</a><br><br>";
		}
	}



	function getproducts_staff() {
		global $mysqli;

		$sql = "SELECT PID,name,price,stock FROM products";

		if(!($stmt = $mysqli->prepare($sql))){
			echo "Error in fetching products!";
			die();
		}

		$stmt->execute();



		$PID = NULL;
		$name = NULL;
		$price = NULL;
		$stock = NULL;

		$stmt->bind_result($PID,$name,$price,$stock);

		while($stmt->fetch()){
			echo "| Name: ".htmlentities($name) . "  | Price: "
				. htmlentities($price) . "  | Stock Left: "
				. htmlentities($stock) . "  |  " ;

			echo "<a href=\"edit.php?pid=" . urlencode($PID) . "\">Edit</a><br><br>";
		}
	}

	function getproductinfo($PID){
		global $mysqli;

		$sql= "SELECT * from products WHERE PID=?";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i",$PID);
		$stmt->execute();

		$result = $stmt->get_result();
		if($result->num_rows==1){
			return $result->fetch_assoc();



		}
		return false;

	}

	function updateproductinfo($PID, $name,$price,$stock,$type){
		global $mysqli;
		$sql="UPDATE products SET name=?, price=?,stock=?,type=?  WHERE PID=?";
		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("sdisi",$name,$price,$stock,$type,$PID);
		
		if ($stmt->execute()){
			echo "edit of product ". $name . " complete! ";
			return TRUE;
		} 
		return False;

	}

	function makepurchase($PID,$quantity){
		global $mysqli;

		$sql= "SELECT * from products WHERE PID=?";

		$stmt = $mysqli->prepare($sql);
		$stmt->bind_param("i",$PID);
		$stmt->execute();

		$result = $stmt->get_result();

		if($result->num_rows==1){
			$row = $result->fetch_assoc();

			$stock = $row["stock"];
			$totalprice =$row["price"]*$quantity;
			$name= $row["name"];
			if($quantity<=$stock){
				
				
				$stock=$stock-$quantity;
				$sql = "UPDATE products SET stock=?
				WHERE PID=?";

				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("ii",$stock,$PID);
				if(!$stmt->execute()) return False;

				$sql = "INSERT INTO purchases (quantityBought,totalPrice,CID,PID)
				VALUES (?,?,?,?)";
				$stmt = $mysqli->prepare($sql);
				$stmt->bind_param("idii",$quantity,$totalprice,$_SESSION["CID"],$PID);
				if($stmt->execute()) {
					echo "order complete! you have ordered " . $quantity . " of ". $name . " for a total price of " .$totalprice."! ";
					return true;
				}
				else return false;
			}
			else return false;


		}
		else{
			return FALSE;
		}

		


	}
?>