<?php 
session_start();
include "connect.php";
if (isset($_POST['comm'])) {
	 $comment = $_POST['comm'];
	 $movie_id = $_POST['movie_id'];
	 $userid = $_SESSION['user_id'];
	 echo "  ".$comment;
     $sorgu1=mysqli_query($conn,"SELECT title FROM movietable
              WHERE id = '$movie_id'");
             $result1=mysqli_fetch_array($sorgu1);
             $title = $result1['title'];


	 $sql= "INSERT INTO comment (comment_id,user_id,movie_id,user_comment) VALUES ('','$userid','$movie_id','$comment')";
    if (mysqli_query($conn, $sql)) {
   header('Location: moviepage.php?movieid='.$movie_id);
} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
 ?>