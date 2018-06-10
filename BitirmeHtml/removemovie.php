<?php
session_start();
        include "connect.php";
 if(isset($_POST['movieid'])){
 	$fromemail = $_SESSION['email'];
            $id = $_POST['movieid'];
            $query1=mysqli_query($conn,"SELECT movie_rate from movie where user_mail='$fromemail' and user_movieid='$id'");
            $resultrate=mysqli_fetch_array($query1);
            $sql = "DELETE FROM movie WHERE user_movieid = '$id'" ;
            $rate =$resultrate['movie_rate'];
            mysqli_query($conn,"UPDATE movietable SET vote_average = vote_average-$rate , vote_count = vote_count - 1 WHERE id = '$id'");
    if (mysqli_query($conn, $sql)) {
   header('Location: profile.php');
}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>