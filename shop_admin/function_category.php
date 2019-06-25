<?php 
	function get_categories(){
		$db = getDB();
		$query = "SELECT * FROM categoties ORDER BY categoryid";
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
	function add_category($categoryname, $description, $by_user){
		$db = getDB();// Connect to database
		$query ="INSERT INTO categoties (categoryname, description, by_user)
				VALUES (:categoryname,:description,:by_user)";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(':categoryname',$categoryname);
			$statement->bindParam(':description',$description);
			$statement->bindParam(':by_user',$by_user);
			$statement->execute();
			$statement->closeCursor();			
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function get_category_by_id($categoryid){
		$db = getDB();// Connect to database
		$query ="SELECT * FROM categoties 
				WHERE categoryid=:categoryid 
				ORDER BY categoryid";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(':categoryid',$categoryid);
			$statement->execute();
			$result = $statement->fetch();
			$statement->closeCursor();
			return $result;
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function delete_category_by_id($categoryid){
		$db = getDB();// Connect to database
		$query ="DELETE  FROM categoties 
				WHERE categoryid=:categoryid";
		try {
			$statement = $db->prepare($query);
			$statement->bindParam(':categoryid',$categoryid);
			$statement->execute();			
			$statement->closeCursor();		
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}

	function update_category($categoryid,$categoryname,$description,$by_user){
		$db = getDB();// Connect to database
		$query ="UPDATE categoties
				SET  categoryname =?,
					 description=?,
					 by_user=?					 
				WHERE categoryid=?";
		try {
			$statement = $db->prepare($query);			
			$statement->bindParam(1,$categoryname);
			$statement->bindParam(2,$description);			
			$statement->bindParam(3,$by_user);
			$statement->bindParam(4,$categoryid);
			$statement->execute();			
			$statement->closeCursor();		
		} catch (PDOException $e) {
			$error_message = $e->getMessage();
			echo "Error execute query statement:".$error_message; 
		}
	}
?>