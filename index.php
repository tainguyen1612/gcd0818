<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World from Netbeans</p>'; 
    putenv("DATABASE_URL=GR");
    echo getenv("DATABASE_URL")
 ?> 
    
<?php
$txt1 = "Learn PHP";
$txt2 = "FPT Greenwich";
$x = 5;
$y = 5;

echo "<h2>" . $txt1 . "</h2>";
echo "Study PHP at " . $txt2 . "<br>";
echo $x + $y;



if (empty(getenv("DATABASE_URL"))){
    echo '<p>Chua co CSDL</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>Da co CSDL</p>';
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=%s;port=%s;user=%s;password=%s;dbname=%s",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "SELECT id, name FROM label";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();

foreach ($resultSet as $row) {
	echo $row['name'] . '\n';
}

?>
 </body>
</html>