<?php session_start();
        include "connect.php";

 if(isset($_POST['req5'])){
 					$fromemail = $_SESSION['email'];
            		$id = $_POST['req5'];
           		 	$rate = $_POST['rating'];
            		

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





 	        $query1=mysqli_query($conn,"SELECT user_movieid from movie where user_mail='$fromemail' and user_movieid='$id'and status= 1");
			    $query2=mysqli_query($conn,"SELECT user_movieid,movie_rate from movie where user_mail='$fromemail' and user_movieid='$id'and status= 0");
          
              if(mysqli_num_rows($query1)>0)
              {
               	   $sql= "UPDATE movie SET status = 0, movie_rate = '$rate' WHERE user_mail='$fromemail' and user_movieid='$id'and status= 1";
                   mysqli_query($conn,"UPDATE movietable SET vote_average = vote_average+$rate , vote_count = vote_count + 1");
                   
              } 
              else{ 
              if(mysqli_num_rows($query2)>0)
              {
                   $resultrate=mysqli_fetch_array($query2);
                   $oldrate=$resultrate['movie_rate'];
               	   $sql= "UPDATE movie SET movie_rate = '$rate' WHERE user_mail='$fromemail' and user_movieid='$id'and status= 0";
                   mysqli_query($conn,"UPDATE movietable SET vote_average = (vote_average-$oldrate)+$rate");

              } else{

                   $sql = "INSERT INTO movie (user_mail,user_movieid,movie_rate) VALUES ( '$fromemail','$id','$rate')" ;       
                   mysqli_query($conn,"UPDATE movietable SET vote_average = vote_average+$rate , vote_count = vote_count + 1");
              } 

 	}
    if (mysqli_query($conn, $sql)) {
   header('Location: moviepage.php?movieid='.$id);

}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>