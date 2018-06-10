<?php
 session_start();
 include "connect.php";
 if(!isset($_SESSION['name'])){
header('Location: index.php');
 }
 ?>
 <!DOCTYPE html>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Search</title>
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
  body{
    background-image: url('3.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
input {
    width: 300px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    background-color: white;
    background-repeat: no-repeat;
    padding: 12px 20px 12px 40px;
    -webkit-transition: width 0.4s ease-in-out;
    transition: width 0.4s ease-in-out;
    margin: 10px;
}

.searchtext{
  width: 20%;
}
.searchdiv{
  margin-top: 30px;
}
input[class=searchtext]:focus {
    width: 40%;
}
</style>
    </head>
    <body>
      <?php include "top.php";  ?>
      <div class="searchdiv" align="center">
  <form action="social.php" method="POST">

  <input type="text" class="searchtext" name="actor-title" placeholder="Search for People..">
  <button  style="margin-bottom: 2px; width: 100px" type="submit" name="search" >Search</button>
  </form>
  </div>

<?php  

  if(isset($_POST['actor-title'])):
  $actor = $_POST["actor-title"];

$actorquery=mysqli_query($conn, "SELECT * FROM user WHERE user_name LIKE '%$actor%'"); 

 while($row = $actorquery->fetch_assoc()):?>

              <form action="profile.php" method="post" >          
            <button style="margin-bottom: 2px; width: 100px margin-top: 2px;" type="submit" name = "usermail"  value = <?php echo '"'.$row['user_mail'].'"' ?> /><?php echo $row['user_name'] ?></button>
            </form>

<?php 
endwhile;
endif;
?>
    </body>
</html>