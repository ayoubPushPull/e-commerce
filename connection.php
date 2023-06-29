<?php
$servername = "localhost";
$username = "root";
$password = "";
try {
  $conn = new PDO("mysql:host=$servername;dbname=e_commerce", $username, $password);
  // echo "Connected successfully";
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>