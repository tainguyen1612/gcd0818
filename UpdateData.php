<!DOCTYPE html>
<html>
<body>

<h1>INSERT DATA TO DATABASE</h1>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into student table</h2>
<ul>
    <form name="UpdateData" action="UpdateData.php" method="POST" >
<li>Student ID:</li><li><input type="text" name="stuid" /></li>
<li>Full Name:</li><li><input type="text" name="fname" /></li>
<li>Email:</li><li><input type="text" name="email" /></li>
<li>Class:</li><li><input type="text" name="classname" /></li>
<li><input type="submit" /></li>
</form>
</ul>


<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
         "host=ec2-23-21-186-85.compute-1.amazonaws.com;port=5432;user=gjkanhkygrxcfo;password=0d0121b7476626adb8b7d789628807494f697e356df1d6bfac75d147ed1b2b59;dbname=defkkt80jebn5c",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();

$sql = "UPDATE student SET fname = ? , email = ? , classname = ? WHERE stuid = ? ";
      $stmt = $pdo->prepare($sql);
      	$stmt->bindParam(1,$_POST['fname']);
	$stmt->bindParam(2,$_POST['email']);
	$stmt->bindParam(3,$_POST['classname']);
	$stmt->bindParam(4,$_POST['stuid']);
        $stmt->execute();
        $stmt->closeCursor();
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
