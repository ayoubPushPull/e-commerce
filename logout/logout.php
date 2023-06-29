<?php 
session_start();
if(isset($_GET["id"])){
session_unset();
}
header('Location:../login/login.php');
?>