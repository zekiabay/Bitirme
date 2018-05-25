<?php session_start();
        include "connect.php";

 if(isset($_POST['req5'])){
 					$fromemail = $_SESSION['email'];
            		$title = $_POST['req5'];
           		 	$rate = $_POST['rating'];
            		
 	        $query1=mysqli_query($conn,"SELECT user_movie from movie where user_mail='$fromemail' and user_movie='$title'and status= 1");
			$query2=mysqli_query($conn,"SELECT user_movie from movie where user_mail='$fromemail' and user_movie='$title'and status= 0");
              if(mysqli_num_rows($query1)>0)
              {
               	   $sql= "UPDATE movie SET status = 0, movie_rate = '$rate' WHERE user_mail='$fromemail' and user_movie='$title'and status= 1";
              } 
              else{ 
              if(mysqli_num_rows($query2)>0)
              {
               	   $sql= "UPDATE movie SET movie_rate = '$rate' WHERE user_mail='$fromemail' and user_movie='$title'and status= 0";

              } else{

                   $sql = "INSERT INTO movie (user_mail,user_movie,movie_rate) VALUES ( '$fromemail','$title','$rate')" ;         
              } 

 	}
    if (mysqli_query($conn, $sql)) {
   header('Location: profile.php');

}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>