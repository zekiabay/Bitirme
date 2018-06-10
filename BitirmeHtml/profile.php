<?php
 session_start();
 if(!isset($_SESSION['name'])){
header('Location: index.php');
 }
 ?>
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

body{
    background-image: url('3.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

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
    <div>
        <?php  include "top.php"; 
          include "connect.php"; ?>
       </div>
       <div align="center">
<form method="POST" action="image.php" enctype="multipart/form-data">
 <input type="file" name="myimage">
 <input type="submit" name="submit_image" value="Upload">
</form>
  <?php 
  if (isset($_POST['usermail'])) {
      $user_mail = $_POST['usermail'];
  }
  else{
  $user_mail = $_SESSION["email"];
}

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
} ?>

</div>
<div align="center">
  <form action="profile.php" method="POST">
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="<?php echo '"'.$user_mail.'"' ?>" name = "chowatched" >Watched Movies</button>
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="<?php echo '"'.$user_mail.'"' ?>" name = "chomovie" >Movies to Watch</button>
     <?php if (isset($_POST['usermail'])): ?>
       <button  style="margin-bottom: 2px; width: 200px" type="submit" value="" name = "cho1" >Follow</button>
     <?php else: ?>
       <button  style="margin-bottom: 2px; width: 200px" type="submit" value="recom" name = "cho1" >Get Recommendation</button>
     <?php endif ?>
    
     </form>
</div>
  <?php 
    if (isset($_POST['chowatched']) or isset($_POST['chomovie'])) {

       if (isset($_POST['chowatched'])) {
  $choise = $_POST['chowatched'];
  $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$choise' and status=0) ORDER BY revenue desc LIMIT 25";
  
}elseif (isset($_POST['chomovie']) ){
  $choise1 = $_POST['chomovie'];
  $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$choise1' and status=1) ORDER BY revenue desc LIMIT 25";
}



$result = $conn->query($sql);


if ($result->num_rows > 0) : ?>
    
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 50px;" loop="99999">
 <?php   while($row = $result->fetch_assoc()) :
  
    echo '<a href="moviepage.php?movieid='.$row['id'].'"><img alt='.$row['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $row['poster_path'].'"></a>' ;

/*$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

echo $path."'\'".$row['title'].";".$row['id'].";";*/
    endwhile;?>
    </marquee>
<?php endif; 






    }elseif (isset($_POST['cho1']) or !isset($_POST['cho'])){

$re = mysqli_query($conn,"SELECT user_rec FROM user WHERE user_mail='$user_mail'");
//$re ="448290,5422";
$rearray = mysqli_fetch_array($re);
if($rearray['user_rec']=="") :?>
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 50px;" loop="99999">
 
<?php   $r = mysqli_query($conn,"SELECT title, poster_path,id FROM movietable LIMIT 25");
   
while($ow = $r->fetch_assoc()){
echo '<a href="moviepage.php?movieid='.$ow['id'].'"><img alt='.$ow['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $ow['poster_path'].'"></a>' ;
}?>
</marquee>
<?php
else:
 
   $arr = explode(",", $rearray['user_rec']);?>
    <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 50px;" loop="99999">
<?php 
for($i=0;$i<count($arr);$i++){

  $r = mysqli_query($conn,"SELECT title,poster_path,id FROM movietable WHERE id=$arr[$i]");
   
while($ow = $r->fetch_assoc()){
echo '<a href="moviepage.php?movieid='.$ow['id'].'"><img alt='.$ow['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $ow['poster_path'].'"></a>' ;
}
}
endif;
 
    }
?>
   </marquee>



</body>
</html>