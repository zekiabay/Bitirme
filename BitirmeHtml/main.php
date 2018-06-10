<?php
 session_start();
 if(!isset($_SESSION['name'])){
header('Location: index.php');
 }
 ?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
    .searchbar{
    
    }
.tops{
  margin-top: 11px;
  width: 50%;
float: left;
}
.searchtext.{
  width: 50%;
float: right;
}
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
.searcharea{
}
input {
    width: 200px;
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
select{
      width: 220px;
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

input[class=searchtext]:focus {
    width: 25%;
}
</style>
</head>
	<body >



		  <div>
        <?php  include "top.php"; ?>
         </div>
        <br>
        <br>
	<div class="form">
<?php 
 include "connect.php"; 

(String)$a= $_SESSION['name'];
(String)$c= $_SESSION['surname'];

 ?>
 <div class="searchbar" align="center">

<form action="main.php" class="tops" method="POST">
     <button  style="margin-bottom: 2px; width: 200px;" type="submit" value="mostviewed" name = "cho" >Top Box Office</button>
     <button  style="margin-bottom: 2px; width: 200px;" type="submit" value="toprated" name = "cho" >Top Rated</button>
     </form>

  <form action="main.php" method="POST">

  <input type="text" class="searchtext" name="actor-title" placeholder="Search..">
  <button  style="margin-bottom: 2px; width: 100px" type="submit" name="search" >Search</button>
  </form>
  <br>
  <br>

    



</div>


 <!-- <h2><?php echo "Welcome ".$a." ".$c;  ?></h2>-->
	</div>
	
	    <?php if(isset($_POST['search'])) : 
        if(isset($_POST['actor-title'])){
        $flag=1;
        $posttitle=$_POST['actor-title'];
        $postactor=$_POST['actor-title'];
      }else{
  $flag=0;
      $posttitle="";
      $postactor="";
    }
      
        $cond = "";
          
        if($posttitle!=""){
          $title = $posttitle;
          $title="%".$title."%";
          $cond = "title LIKE '$title'";
          }



          if($postactor!="") {  
          $actor = $postactor;
            
           $actorsorgu=mysqli_query($conn,"SELECT actor_id FROM actor
              WHERE actor_name ='$actor'");
             $actorarray =[];
             $ind=0;
             while($r = $actorsorgu->fetch_assoc()){
               # code...
                $acid=$r['actor_id'];
               $actormoviesorgu=mysqli_query($conn,"SELECT DISTINCT(movie_id) FROM movieactor
              WHERE actor_id = '$acid'");
               // $act=mysqli_fetch_array($actormoviesorgu);
                   while($ro = $actormoviesorgu->fetch_assoc()){
             $actorarray[$ind]=$ro['movie_id'];
             //echo $s1[$a]." ";
              $ind++;
          }
               
             }
          }else{
               $actorarray=[];
          }



           if(isset($_POST['year']) and $_POST['year']) {
          $year = $_POST['year'];
          if($cond == ""){
            $cond = "release_date LIKE '%$year%'";
          }else{
            $cond = "$cond AND release_date LIKE '%$year%'";
          }
        }


           if(isset($_POST['language']) and $_POST['language'] and $_POST['language']!="") {
          $language = $_POST['language'];
          if($cond == ""){
            $cond = "language = '$language'";
          }else{
            $cond = "$cond AND language = '$language'";
          }
         }

           if(isset($_POST['productor']) and $_POST['productor']){
          $production = $_POST['productor'];
           $production="%".$production."%";
          $productionsorgu=mysqli_query($conn,"SELECT production_id FROM production
              WHERE production_name LIKE '$production'");
              $productionarray =[];
             $ind1=0;
             while($r1 = $productionsorgu->fetch_assoc()){
                $prodid=$r1['production_id'];
               $productionmoviesorgu=mysqli_query($conn,"SELECT DISTINCT(movie_id) FROM movieproduction
              WHERE production_id = '$prodid'");
                   while($ro1 = $productionmoviesorgu->fetch_assoc()){
             $productionarray[$ind1]=$ro1['movie_id'];
              $ind1++;
          }
             }
           }else{
               $productionarray=[];
           
 }

           if(isset($_POST['minrate']) and $_POST['minrate']) { 
          $minrate = $_POST['minrate'];
          if($cond == ""){
            $cond = "vote_average/vote_count >= $minrate AND vote_count>=10";
          }else{
            $cond = "$cond AND vote_average/vote_count >= $minrate AND vote_count>=10";
          }
        }

             if(isset($_POST['category']) and $_POST['category'] and $_POST['category']!=""){
          $category = $_POST['category'];
           $category="%".$category."%";
      $categorysorgu=mysqli_query($conn,"SELECT category_id FROM category
              WHERE category_name LIKE '$category'");
             $categoryarray =[];
             $ind2=0;
             while($r2 = $categorysorgu->fetch_assoc()){
               # code...
                $catid=$r2['category_id'];
               $categorymoviesorgu=mysqli_query($conn,"SELECT DISTINCT(movie_id) FROM moviecategory
              WHERE category_id = '$catid'");
                   while($ro2 = $categorymoviesorgu->fetch_assoc()){
             $categoryarray[$ind2]=$ro2['movie_id'];
              $ind2++;
          }              
             }
          }else{         
               $categoryarray=[];   
          }



          if($cond == ""){
            $sorgu=mysqli_query($conn,"SELECT DISTINCT(id) FROM movietable ");
          }else{
            $sorgu=mysqli_query($conn,"SELECT DISTINCT(id) FROM movietable WHERE $cond");

          }
          $s1=[];
          $a=0;
          while($row1 = $sorgu->fetch_assoc()){
             $s1[$a]=$row1['id'];
              $a++;
          }

      
            if($flag==1){

          $sonuc2= array_unique(array_merge($actorarray, $s1));
          }else{
          if($actorarray && $categoryarray && $productionarray){
          $sonuc = array_intersect($s1, $actorarray);
          $sonuc1 = array_intersect($sonuc,$categoryarray);
          $sonuc2 = array_intersect($sonuc1, $productionarray);
        }
          elseif(!$actorarray && $categoryarray && $productionarray){
          $sonuc1 = array_intersect($s1,$categoryarray);
          $sonuc2 = array_intersect($sonuc1, $productionarray);
          }
          elseif(!$actorarray && !$categoryarray && $productionarray){

          $sonuc2 = array_intersect($s1, $productionarray);
          }
          elseif(!$actorarray && $categoryarray && !$productionarray){

          $sonuc2 = array_intersect($s1, $categoryarray);
          }
             elseif($actorarray && !$categoryarray && !$productionarray){

          $sonuc2 = array_intersect($s1, $actorarray);
          }
          elseif($actorarray && $categoryarray && !$productionarray){
          $sonuc1 = array_intersect($s1,$categoryarray);
          $sonuc2 = array_intersect($sonuc1, $actorarray);
          }
           elseif($actorarray && !$categoryarray && $productionarray){
          $sonuc1 = array_intersect($s1,$productionarray);
          $sonuc2 = array_intersect($sonuc1, $actorarray);
          }else{
            $sonuc2=$s1;
          }
    } 
          if (count($sonuc2) > 0) :
          if (count($sonuc2) >100) {
$sonuc2 = array_slice($sonuc2, 0,100);}
           
        
          
           if (count($sonuc2)>7):?>
          <div class="form">
            <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" style="position: absolute; bottom:50px;" loop="99999">
          <?php foreach ($sonuc2 as $key => $value) :
 $fetch=mysqli_query($conn,"SELECT title,id,poster_path FROM movietable WHERE id='$value'");
$fetcharray=mysqli_fetch_array($fetch);
           ?>
                  
           <?php echo '<a href="moviepage.php?movieid='.$fetcharray['id'].'"><img width="150" height="240" src="https://image.tmdb.org/t/p/original'. $fetcharray['poster_path'].'"></a>' ;

           
            endforeach;?>
            </marquee>

            <?php else: ?>
              <div style="position:absolute; bottom:50px;">  
<?php foreach ($sonuc2 as $key => $value) :
 $fetch=mysqli_query($conn,"SELECT title,id,poster_path FROM movietable WHERE id='$value'");
$fetcharray=mysqli_fetch_array($fetch);
           ?>
              
           <?php echo '<a  href="moviepage.php?movieid='.$fetcharray['id'].'"><img width="150" height="240" src="https://image.tmdb.org/t/p/original'. $fetcharray['poster_path'].'"></a>' ;

          

            endforeach; ?>

 </div>  
<?php endif;
             ?>
            
            </div>

             
            <?php endif;
        ?>   
      <?php endif;?> 
      
<div class="searcharea"  align="center">
  <div class="form">
        <form action="main.php" method="post" >   
<!--
             <div class="field-wrap">
              <label>
                Movie Title<span class="req"></span>
              </label>
              <input type="text" class="input" name="title"  />
            </div>

            <div class="field-wrap">
              <label>
                Actor<span class="req"></span>
              </label>
              <input type="text" class="input" name="actor"  />
            </div>
-->
            <div class="field-wrap" style="float: left;">
              <label>
              <span class="req"></span>
              </label>
                             <select name="year">
                <option value="">Year</option>
                <?php for ($i=2018; $i >1950 ; $i--): ?>
                <option value=<?php echo $i ?>  ><?php echo $i ?></option>  
                    <?php endfor; ?>              
              </select>
            </div>

            <div class="field-wrap" style="float: left;">
              <label>
                <span class="req"></span>
              </label>
              <select name="language">
                <option value="">Language</option>
                <option value="en">English</option>
                <option value="fr">French</option> 
                <option value="de">German</option>
                <option value="tr">Turkish</option>
                <option value="ar">Arabic</option>
                <option value="zh">Chinese</option>
                <option value="it">Italian</option>
                <option value="ja">Japanese</option>
                <option value="ko">Korean</option>
                <option value="sk">Slovak</option>
                <option value="es">Spanish</option>
                <option value="pt">Portuguese</option>
                </select>
            </div>

            <div class="field-wrap" style="float: left;">
             
              <input type="text" placeholder="Productor" class="input" name="productor">
            </div>

            <div class="field-wrap" style="float: left;">
              
               <select name="minrate">
                <option value="">Rate</option>
                <option value="4">4+</option>
                <option value="5">5+</option>                
                <option value="6">6+</option>
                <option value="7">7+</option>
                <option value="8">8+</option>
                <option value="9">9+</option>

              </select>
            </div>
            <div class="field-wrap" style="float: left;">
          
                <select name="category">
                <option value="">Choose Category</option>
                <option value="Action">Action</option>
                <option value="Animation">Animation</option>                
                <option value="Adventure">Adventure</option>
                <option value="Comedy">Comedy</option>
                <option value="Crime">Crime</option>
                <option value="Documentary">Documentary</option>
                <option value="Drama">Drama</option>
                <option value="Family">Family</option>
                <option value="Fantasy">Fantasy</option>
                <option value="Foreign">Foreign</option>
                <option value="History">History</option>
                <option value="Horror">Horror</option>
                <option value="Music">Music</option>
                <option value="Romance">Romance</option>
                <option value="Science Fiction">Science Fiction</option>
                <option value="TV Movie">TV Movie</option>
                <option value="Mystery">Mystery</option>
                <option value="Thriller">Thriller</option>
                <option value="War">War</option>
                <option value="Western">Western</option>
                </select>

            </div>       
            <button style="margin: 10px;" type="submit" name="search"> Search </button>
        </form>
        
        </div>
</div>

<br>
<br>
<br><?php
if(!isset($_POST['search'])):?>




    <?php 
    if (isset($_POST['cho'])) {
        $choise = $_POST['cho'];
        if ($choise=="mostviewed") {
            $sql = "SELECT title, poster_path,id FROM movietable ORDER BY revenue desc LIMIT 25";
        }
        elseif ($choise=="toprated") {
             $sql = "SELECT title, poster_path,id FROM movietable  where vote_count>20 ORDER BY vote_average/vote_count desc LIMIT 25";
        }
    }else{
         $sql = "SELECT title, poster_path,id FROM movietable LIMIT 25";
    }




$result = $conn->query($sql);


if ($result->num_rows > 0) : ?>
    
  <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" style="position: absolute; bottom:50px;"
scrolldelay="60" style="position: absolute;" loop="99999">
 <?php   while($row = $result->fetch_assoc()) :
  
    echo '<a href="moviepage.php?movieid='.$row['id'].'"><img alt='.$row['title'].' width="150" height="240" src="https://image.tmdb.org/t/p/original'. $row['poster_path'].'"></a>' ;

/*$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

echo $path."'\'".$row['title'].";".$row['id'].";";*/
    endwhile;?>
    </marquee>
<?php endif; 

$conn->close();


    ?>


<div id="demo"></div>
<?php endif; ?>
</body>
</html>