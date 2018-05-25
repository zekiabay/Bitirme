<?php 
session_start();
include "connect.php"; 
if(isset($_POST['user_name'])){
	$user_name = $_POST["user_name"];
	$user_surname = $_POST["user_surname"];
	$user_mail = $_POST["user_mail"];
	$user_pass = $_POST["user_pass"];
	 $_SESSION['name']=$user_name;
 	$_SESSION['surname']=$user_surname;
 	$_SESSION['email']=$user_mail;
	 $sql= "INSERT INTO user (user_name,user_surname,user_id,user_mail,user_pass) VALUES ('$user_name','$user_surname','','$user_mail','$user_pass')";
    if (mysqli_query($conn, $sql)) {
   header('Location: main.php');
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>