<?php 
include "connect.php"; 
session_start();
if (!empty($_POST["user_mail"])&&!empty($_POST["user_name"])&&!empty($_POST["user_surname"])) {
	 $user_mail = $_POST["user_mail"];
	 $user_name = $_POST["user_name"];
	 $user_surname = $_POST["user_surname"];

 $sorgu1= mysqli_query($conn,"SELECT user_mail FROM user WHERE user_mail='$user_mail' AND user_name='$user_name' AND user_surname='$user_surname'");
 //$sorgu2=mysqli_query($conn,"SELECT user_surname FROM user WHERE user_mail='$user_mail' and user_pass='$user_pass'");
 $result1=mysqli_fetch_array($sorgu1);
 $user_mail = $result1['user_mail'];
 $_SESSION['user_mail']=$user_mail;
if($user_mail){

	header('Location: refpass.php');
}
else{
	echo "Your mail or password is wrong! ";
	header('Location: index.php');
}
}
else{
	header('Location: index1.php');
}
?>