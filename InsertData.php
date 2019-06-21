<!DOCTYPE html>
<html>
    <head>
<title>Insert data to PostgreSQL with php - creating a simple web application</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
li {
list-style: none;
}
</style>
</head>
<body>
<h1>INSERT DATA TO DATABASE</h1>
<h2>Enter data into student table</h2>
<ul>
    <form name="InsertData" action="InsertData.php" method="POST" >
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

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";

$sql = "INSERT INTO student(stuid, fname, email, classname)"
        . " VALUES('$_POST[stuid]','$_POST[fname]','$_POST[email]','$_POST[classname]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[stuid])) {
   echo "StudentID must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
