<!DOCTYPE html>
<html>
<body>

<h1>DATABASE CONNECTION</h1>

<?php
ini_set('display_errors', 1);
echo "Hello Cloud computing class 0818!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The DB exists</p>';
     echo getenv("dbname");
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

$sql = "SELECT * FROM student ORDER BY stuid";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Students information:</p>';
foreach ($resultSet as $row) {
	echo $row['stuid'];
        echo "    ";
        echo $row['fname'];
        echo "    ";
        echo $row['email'];
        echo "    ";
        echo $row['classname'];
        echo "<br/>";
}

?>
</body>
</html>
