<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World from Netbeans</p>'; 
    putenv("DATABASE_URL=fred");
    echo getenv("DATABASE_URL")
 ?> 
     
 </body>
</html>