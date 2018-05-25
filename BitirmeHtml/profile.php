<!DOCTYPE html>
<html>
<head>
	  <meta charset="UTF-8">
  <title>Profile</title>
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
button {
  border-radius: 4px;
  border: none;
  text-align: center;
  font-size: 12px;
  padding: 1px;
  height: 40px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

button:hover span {
  padding-right: 25px;
}

button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
<body>
  <?php  include "top.php"; ?>
<form method="POST" action="image.php" enctype="multipart/form-data">
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>
<div>
  <?php 
  session_start();
  include "connect.php"; 
  $user_mail = $_SESSION["email"];

//header('Location: index.php');
$select_path="SELECT * FROM user WHERE user_mail='$user_mail'";

$var1=mysqli_query($conn,$select_path);

while($row=mysqli_fetch_array($var1))
{
  if($row['user_photo']){
    $image_name=$row['user_photo'];
 $image_path=$row['user_folder'];
 echo '<img src="'.$image_name.'" width="10%" height="10%">';
}else{
  echo '<img src="noldu.jpeg" width="10%" height="10%">';
}
 
 //echo $image_path.$image_name;
} ?>
</div>
<div class="form">
<h3>My Watched Movies</h3>
  <?php 
   include "connect.php"; 
    $user_mail = $_SESSION["email"];
    $sorgu1= mysqli_query($conn,"SELECT user_movie FROM movie WHERE user_mail='$user_mail' and status=0 ");

       while($row = $sorgu1->fetch_assoc()) : ?>
              
            <form action="moviepage.php" method="get" >          
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "movietitle" class="rem" value = <?php echo '"'.$row['user_movie'].'"' ?>  /> <?php echo $row['user_movie'] ?> </button>
            </form>
              <form action="removemovie.php" method="post" >          
            <button style="margin-bottom: 2px; width: 30px" type="submit" name = "movietitle"  value = <?php echo '"'.$row['user_movie'].'"' ?> /> X </button>
            </form>
            <?php endwhile;

   ?>
	</div>
  <div class="form">
    <h3>My Movies to Watch</h3>
    <?php 
    $user_mail = $_SESSION["email"];
    $sorgu= mysqli_query($conn,"SELECT user_movie FROM movie WHERE user_mail='$user_mail' and status=1 ");

       while($row1 = $sorgu->fetch_assoc()) : ?>
              
            <form action="moviepage.php" method="get" >          
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "movietitle" class="rem" value = <?php echo '"'.$row1['user_movie'].'"' ?>   /> <?php echo $row1['user_movie'] ?> </button>
            </form>
              <form action="removemovie.php" method="post">          
            <button style="margin-bottom: 2px; width: 30px" type="submit" name = "movietitle"  value = <?php echo '"'.$row1['user_movie'].'"' ?> /> X </button>
            </form>
            <?php endwhile;

   ?>
  </div>
</body>
</html>