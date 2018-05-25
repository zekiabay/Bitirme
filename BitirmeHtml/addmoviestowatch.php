<?php session_start();
        include "connect.php";
 if(isset($_POST['reqwatch'])){
 	 $fromemail = $_SESSION['email'];
            $title = $_POST['reqwatch'];
            $sql = "INSERT INTO movie (user_mail,user_movie,status) VALUES ( '$fromemail','$title','1')" ;
    if (mysqli_query($conn, $sql)) {
   header('Location: profile.php');

}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>