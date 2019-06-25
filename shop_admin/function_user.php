<?php
    function get_user()
    {
        $db = getDB();
		$query = "SELECT * FROM user ORDER BY user_id";
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
    function check_user($user_name , $password)
    {   
        //lay tat ca user
        $list_user = get_user();
        $found = false;
        foreach ($list_user as $key => $value) {
            if($value['username']==$user_name&&$value['password']==$password)
            {
                $found = true;
                break;
            }
        }
        return $found;
    }
?>