<!DOCTYPE html>
<html>
<body>

<h1>INSERT DATA TO DATABASE</h1>

<?php
ini_set('display_errors', 1);
echo "Insert database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-174-129-240-67.compute-1.amazonaws.com;port=5432;user=wrflrxtavasvqh;password=fbfef36049fbd28f1200e3a775a389e014838e86522765e67782f9cf7a3f516b;dbname=d3mmhribgmc6bf",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

//Khởi tạo Prepared Statement
//$stmt = $db->prepare('INSERT INTO student (ID, name, email, class) values (:id, :name, :email, : class)');

//$stmt->bindParam(':ID','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
$sql = "INSERT INTO student (ID, name, email, class) 
    values('SV03', 'Ho Hong Linh','Linhhh@fpt.edu.vn','GCD018')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
if($stmt->execute() == TRUE){
    echo "Record inserted successfully";
} else {
    echo "Error inderting record: ";
}
?>
</body>
</html>
