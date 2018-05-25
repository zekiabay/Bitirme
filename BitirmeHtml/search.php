<?php 
session_start();
include "connect.php"; 
if(isset($_POST['search'])){
	$search = $_POST["search"];
	$sorgu1= mysqli_query($conn,"SELECT title,language FROM movietable WHERE LOWER(CONCAT(title, '', language)) ");
	$result1=mysqli_fetch_array($sorgu1);
	echo "Result : ".$result1["title"]." ".$result1["language"];
}
?>