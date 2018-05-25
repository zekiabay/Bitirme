<?php 
session_start();
include "connect.php"; 
if (!empty($_POST["pass"])&&!empty($_POST["repass"])) {
	 $pass = $_POST["pass"];
	 $repass = $_POST["repass"];
	 if ($pass==$repass) {
	 	$usermail=$_SESSION['user_mail'];
	 	$sql= "UPDATE user SET user_pass = '$pass' WHERE user_mail='$usermail'";
	 	mysqli_query($conn,$sql);
	 	header('Location: index1.php');
	 }
	 else{
	 	header('Location: refpass.php');
	 }

}
else{
		header('Location: refpass.php');
}
?>