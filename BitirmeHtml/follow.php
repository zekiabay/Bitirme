<?php 
include "connect.php";
session_start();
$user_mail= $_SESSION['email'];

if (isset($_POST['follow'])) {

$usermail=$_POST['follow'];
//echo $usermail." ".$user_mail;

$re = mysqli_query($conn,"SELECT user_follow FROM user WHERE user_mail= '$user_mail' ");
 $rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['user_follow']);
array_push($arr, $_POST['follow']);
$new = implode(",", $arr);

mysqli_query($conn,"UPDATE user SET user_follow = '$new' WHERE user_mail='$user_mail'");
header('Location: otherprofile.php?usermail='.$usermail);
}







elseif (isset($_POST['unfollow'])) {
	$other =$_POST['unfollow'];
	$re = mysqli_query($conn,"SELECT user_follow FROM user WHERE user_mail= '$user_mail' ");
 $rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['user_follow']);
 for($i=0;$i<count($arr);$i++){
 	if($arr[$i]==$other){
unset($arr[$i]);
$new = implode(",", $arr);
}}
mysqli_query($conn,"UPDATE user SET user_follow = '$new' WHERE user_mail='$user_mail'");
header('Location: otherprofile.php?usermail='.$other);
}
 ?>