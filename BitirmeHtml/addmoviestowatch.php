<?php session_start();
        include "connect.php";
 if(isset($_POST['reqwatch'])){
 	 $fromemail = $_SESSION['email'];
            $id = $_POST['reqwatch'];

      $re = mysqli_query($conn,"SELECT user_rec FROM user WHERE user_mail='$fromemail'");

$rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['user_rec']);
 for($i=0;$i<count($arr);$i++){
if($arr[$i]==$id){
  unset($arr[$i]);
$string= implode(",",$arr);
  mysqli_query($conn,"UPDATE user SET user_rec = '$string' WHERE user_mail='$fromemail'");
}

 }



            $sql = "INSERT INTO movie (user_mail,user_movieid,status) VALUES ( '$fromemail','$id','1')" ;
    if (mysqli_query($conn, $sql)) {
   header('Location: moviepage.php?movieid='.$id);

}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>