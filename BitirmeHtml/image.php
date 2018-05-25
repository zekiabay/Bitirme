<?php
session_start();
 include "connect.php"; 
$user_mail = $_SESSION["email"];
$upload_image=$_FILES["myimage"]["name"];
$upload_tmp=$_FILES["myimage"]["tmp_name"];
//echo $upload_image;
//echo $upload_tmp;
//echo $_FILES["myimage"]["tmp_name"];
$folder="C:/xampp/htdocs/BitirmeHtml/";
//echo $_FILES['myimage']['tmp_name'];
move_uploaded_file($_FILES['myimage']['tmp_name'],$folder.$_FILES['myimage']['name']);

$insert_path= "UPDATE user SET user_photo = '$upload_image' , user_folder = '$folder' WHERE user_mail='$user_mail'";
  $var=mysqli_query($conn,$insert_path);
header('Location: profile.php');
?>

