<?php 

session_start();

include "connect.php"; 
if (!empty($_POST["user_mail"])&&!empty($_POST["user_pass"])) {
	 $user_mail = $_POST["user_mail"];
 	 $_SESSION['email']=$user_mail;

 $sorgu1= mysqli_query($conn,"SELECT user_name,user_surname FROM user WHERE user_mail='$user_mail'");
 //$sorgu2=mysqli_query($conn,"SELECT user_surname FROM user WHERE user_mail='$user_mail' and user_pass='$user_pass'");
 $result1=mysqli_fetch_array($sorgu1);
 $user_surname=$result1["user_surname"];
 $user_name=$result1["user_name"];
 $_SESSION['name']=$user_name;
 $_SESSION['surname']=$user_surname;
 $user_pass = $_POST["user_pass"];
 $sorgu=mysqli_query($conn,"SELECT * FROM user WHERE user_mail='$user_mail' and user_pass='$user_pass'");
 $result=mysqli_fetch_array($sorgu);
  $_SESSION['user_id']=$result["user_id"];
if($result['user_mail']==$user_mail && $result['user_pass']==$user_pass){

	$sorgu1= mysqli_query($conn,"SELECT admin FROM user WHERE user_mail='$user_mail'");
	$result1=mysqli_fetch_array($sorgu1);
	if ($result1['admin']==1) {
   header('Location: admin.php');
	}else{
		echo "Welcome You are directed to Home Page.";
   header('Location: main.php');
	}
	 

	
}
else{
	echo "Your mail or password is wrong! ";
	header('Location: index1.php');
}
}
else{
	header('Location: index1.php');
}
?>