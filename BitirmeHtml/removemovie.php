<?php
        include "connect.php";
 if(isset($_POST['movietitle'])){
            $title = $_POST['movietitle'];
            $sql = "DELETE FROM movie WHERE user_movie = '$title'" ;
    if (mysqli_query($conn, $sql)) {
   header('Location: profile.php');
}
else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 }
             ?>