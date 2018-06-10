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
    background-image: url('4.jpg');
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
button{
  background-color: #99ff99;
  color:black;
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
$user_mail = $_SESSION['email'];
  if(isset($_POST['actor-title'])):
  $actor = $_POST["actor-title"];

$actorquery=mysqli_query($conn, "SELECT * FROM user WHERE user_name LIKE '%$actor%' and user_mail!='$user_mail' and admin=0 "); 

 while($row = $actorquery->fetch_assoc()):?>

          <!--    <form action="otherprofile.php" method="post" >          
            <button style="margin-bottom: 2px; width: 100px margin-top: 2px;" type="submit" name = "usermail"  value = <?php echo '"'.$row['user_mail'].'"' ?> /><?php echo $row['user_name'] ?></button>
            </form>-->
<?php
$e=$row['user_mail'];
$fr=mysqli_query($conn, "SELECT * FROM user WHERE user_mail = '$e'"); 
$fetcar = mysqli_fetch_array($fr);
  if($fetcar['user_photo']){
    $image_name=$fetcar['user_photo'];
 //$image_path=$fetcarr['user_folder'];
 $im='<img src="'.$image_name.'" height="180">';
}else{
 $im= '<img src="noldu.jpeg" height="180">';
}
  echo '<div style="float:left; margin:2px;">';
  ?>
   <h3 style="font-style: oblique;">
         <?php 
       echo $fetcar['user_name']." ".$fetcar['user_surname'];
        ?>
       </h3>
       <?php 
         echo "<br>";
  echo '<a href="otherprofile.php?usermail='.$fetcar['user_mail'].'">'.$im.'</a></label>';
echo '</div>';?>






<?php 
endwhile;
endif;
?>
  
      <div>
          <h3 style="clear: left;">My Friends</h3>
     <?php 
        
        $friend=mysqli_query($conn, "SELECT user_follow FROM user WHERE user_mail = '$user_mail'"); 
$rearray = mysqli_fetch_array($friend);
 $arr = explode(",", $rearray['user_follow']);
 for($i=0;$i<count($arr);$i++):

if($arr[$i]!=""):

 $fri=mysqli_query($conn, "SELECT * FROM user WHERE user_mail = '$arr[$i]'"); 
$fetcarr = mysqli_fetch_array($fri);
  if($fetcarr['user_photo']){
    $image_name=$fetcarr['user_photo'];
 //$image_path=$fetcarr['user_folder'];
 $im='<img src="'.$image_name.'" height="180">';
}else{
 $im= '<img src="noldu.jpeg" height="180">';
}
  echo '<div style="float:left; margin:2px;">';
  ?>
   <h3 style="font-style: oblique;">
         <?php 
       echo $fetcarr['user_name']." ".$fetcarr['user_surname'];
        ?>
       </h3>
       <?php 
  echo "<br>";
  echo '<a href="otherprofile.php?usermail='.$fetcarr['user_mail'].'">'.$im.'</a></label>';

echo '</div>';

       ?>

            <!--  <form action="otherprofile.php" method="post" >          
            <button style="margin-bottom: 2px; width: 100px margin-top: 2px;" type="submit" name = "usermail"  value = <?php echo '"'.$arr[$i].'"' ?> /><?php echo $arr[$i] ?></button>
            </form>-->
   
          <?php endif;endfor; ?>
     
      </div>
    


    </body>
</html>