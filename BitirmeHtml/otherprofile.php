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
button{
  background-color: #99ff99;
  color:black;
}

body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}

</style>
</head>
<body>
    <div>
        <?php  include "top.php"; 
          include "connect.php"; ?>
       </div>

   <div align="center">
         
        <?php 
        if (isset($_REQUEST['usermail'])) {
    $_SESSION['othermail'] = $_REQUEST['usermail'];
}
        $user_mail = $_SESSION["othermail"];
       $dizi= mysqli_query($conn,"SELECT * FROM user WHERE user_mail='$user_mail'");
       $rowa = mysqli_fetch_array($dizi);
       ?>
       <h3 style="font-style: oblique;">
         <?php 
       echo $rowa['user_name']." ".$rowa['user_surname'];
        ?>
       </h3>
        
      

       </div>

       <div align="center">
  <?php 

$user_mail =  $_SESSION['othermail'];
$user =  $_SESSION['email'];

$select_path="SELECT * FROM user WHERE user_mail='$user_mail'";

$var1=mysqli_query($conn,$select_path);

while($row=mysqli_fetch_array($var1))
{
  if($row['user_photo']){
    $image_name=$row['user_photo'];
 $image_path=$row['user_folder'];
 echo '<img src="'.$image_name.'" height="140">';
}else{
  echo '<img src="noldu.jpeg" height="140">';
}
} ?>








</div>
<div align="center">
  <form action="otherprofile.php" method="POST">
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="watched" name = "cho" >Watched Movies</button>
     <button  style="margin-bottom: 2px; width: 200px" type="submit" value="moviesto" name = "cho" >Movies to Watch</button>
     </form>



    <?php    $friend=mysqli_query($conn, "SELECT user_follow FROM user WHERE user_mail = '$user'"); 
$rearray = mysqli_fetch_array($friend);
 $arr = explode(",", $rearray['user_follow']);
 $f=0;
 for($i=0;$i<count($arr);$i++){

if($arr[$i]==$user_mail){
$f=1;
}


}


 ?>



<?php if ($f==0): ?>
  

  <form action="follow.php" method="POST">
       <button  style="margin-bottom: 2px; width: 200px" type="submit" value="<?php echo $user_mail ?>" name = "follow" >Follow</button>
     </form>
<?php else: ?>
<form action="follow.php" method="POST">
       <button  style="margin-bottom: 2px; width: 200px" type="submit" value="<?php echo $user_mail ?>" name = "unfollow" >Unfollow</button>
     </form>
    <?php endif ;?>
</div>






  <?php 
    if (isset($_POST['cho'])) {
        $choise = $_POST['cho'];
        if ($choise=="watched") {
            $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$user_mail' and status=0) ORDER BY revenue desc LIMIT 25";
        }
        elseif ($choise=="moviesto") {
             $sql = "SELECT title, poster_path,id FROM movietable where id IN (SELECT user_movieid FROM movie WHERE user_mail='$user_mail' and status=1) ORDER BY revenue desc LIMIT 25";
        }




$result = $conn->query($sql);


if ($result->num_rows > 0) : ?>
    
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom: 15px;" loop="99999">
 <?php   while($row = $result->fetch_assoc()) :
  
    echo '<a href="moviepage.php?movieid='.$row['id'].'"><img alt='.$row['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $row['poster_path'].'"></a>' ;

/*$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

echo $path."'\'".$row['title'].";".$row['id'].";";*/
    endwhile;?>
    </marquee>
<?php endif; 






    }
?>
   </marquee>


</body>
</html>