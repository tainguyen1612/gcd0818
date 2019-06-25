<?php 
	function get_product(){
		$db = getDB();
		$query = "SELECT * FROM product WHERE categoryid=1 ORDER BY productid";
		try{
			$statement = $db->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		}
		catch (PDOExeception $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message;
		}
	}
	function get_product2(){
		$db = getDB();
		$query = "SELECT * FROM product WHERE categoryid=2 ORDER BY productid";
		try{
			$statement = $db->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		}
		catch (PDOExeception $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message;
		}
	}
	function get_product3(){
		$db = getDB();
		$query = "SELECT * FROM product WHERE categoryid=4 ORDER BY productid";
		try{
			$statement = $db->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		}
		catch (PDOExeception $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message;
		}
	}
	function get_product4(){
		$db = getDB();
		$query = "SELECT * FROM product WHERE categoryid=5 ORDER BY productid";
		try{
			$statement = $db->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll();
			$statement->closeCursor();
			return $result;
		}
		catch (PDOExeception $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message;
		}
	}
	function add_product($productname,$categoryid,$price, $description,$image, $by_user){
		$db = getDB();// Connect to database
		$query ="INSERT INTO product(productname,categoryid,price,description,image,by_user)
				VALUES (?,?,?,?,?,?)";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(1,$productname);
			$statement->bindParam(2,$categoryid);
			$statement->bindParam(3,$price);
			$statement->bindParam(4,$description);
			$statement->bindParam(5,$image);
			$statement->bindParam(6,$by_user);
			$statement->execute();
			$statement->closeCursor();			
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function get_product_by_id($productid){
		$db = getDB();// Connect to database
		$query ="SELECT * FROM product 
				WHERE productid=? 
				ORDER BY productid";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(1,$productid);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function delete_product_by_id($productid){
		$db = getDB();// Connect to database
		$query ="DELETE  FROM product 
				WHERE productid=?";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(1,$productid);
			$statement->execute();			
			$statement->closeCursor();		
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function update_product($productid,$productname, $categoryid, $price, $description, $image,$by_user){
		$db = getDB();// Connect to database
		$query ="UPDATE product
				SET  productname =?,
					 categoryid=?,
					 price=?,					 
					 description=?,
					 image=?,
					 by_user=?					 
				WHERE productid=?";
		try {
			$statement = $db->prepare($query);			
			$statement = $db->prepare($query);
			$statement->bindParam(1,$productname);
			$statement->bindParam(2,$categoryid);
			$statement->bindParam(3,$price);
			$statement->bindParam(4,$description);
			$statement->bindParam(5,$image);
			$statement->bindParam(6,$by_user);
			$statement->bindParam(7,$productid);
			$statement->execute();			
			$statement->closeCursor();		
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}
?>