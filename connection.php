<?php 
$localhost = "localhost";
$user = "root";
$pass = "";
$dbName = "kopi_crafting";

$dbConn = mysqli_connect($localhost, $user, $pass, $dbName);

if(!$dbConn){
    die('<script>alert("Connection failed: Please check your SQL connection!");</script>');
}

?>