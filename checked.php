<?php 
include("connection.php");

$check=isset($_POST["check"])? $_POST["check"]: 0;
$id=isset($_POST["id"])?$_POST["id"]: 0;
$qry=$conn->query("Update guests set checkin='$check' where id= '$id'"); 
?>