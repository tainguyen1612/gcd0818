<html>
 <head>
  <title>Database Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World from Netbeans</p>'; 
   // putenv("DATABASE_URL=GR");
   // echo getenv("DATABASE_URL")

 ?> 
     <a href="ConnectToDB.php" target="_blank" >Connect database</a> 
<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>Chua co CSDL</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>Da co CSDL</p>';
     echo getenv("dbname");
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

$sql = "SELECT id, name FROM users";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>Du lieu trong bang users:</p>';
foreach ($resultSet as $row) {
	echo $row['id'];
        echo $row['name'];
        echo "<br/>";
}

?>
 </body>
</html>