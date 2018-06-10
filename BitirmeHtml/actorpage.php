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
    <title>Actor Page</title>
<link rel="stylesheet" type="text/css" href="index.css">
    

    <style type="text/css">
      .margin{
       margin-left: 450px;
      }
   body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
    </style>
    </head>

    <body onload="myFunction1()">
        <?php  include "top.php"; 
   		 

        include "connect.php"; 
        	   $actorid = $_GET['actor_id'];
             $sorgu1=mysqli_query($conn,"SELECT * FROM actor
              WHERE actor_id = '$actorid'");
             $result1=mysqli_fetch_array($sorgu1);
              	?>
 <h1><?php echo $result1['actor_name']?></h1>   
<div > <?php echo '<img style="float:left; margin: 0px 25px 25px;" alt='.$result1['actor_name'].' width="23%" height="23%" src="https://image.tmdb.org/t/p/original'.$result1['actor_poster'].'">';?>    </div>
             
<div class="margin" >                                 
           
</div>
          <div id="dom-target">
          <?php 
       
     
          $actorid = $_GET['actor_id'];

             $sorgu1=mysqli_query($conn,"SELECT movie_id,actor_cha FROM movieactor
              WHERE actor_id = '$actorid'");
             
            
while($row1 = $sorgu1->fetch_assoc()) {
$id =$row1['movie_id'];
            $sql = "SELECT title, poster_path FROM movietable WHERE id ='$id' ";
            $result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
  
//$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

//echo $path."'\'".$row['title'].";".$row1['movie_id'].";";
echo '<a href="moviepage.php?movieid='.$row1['movie_id'].'"><img style="margin: 0 5px;" width="150" height="240" src="https://image.tmdb.org/t/p/original'. $row['poster_path'].'"></a>';
    }
} else {
    echo "0 results";
}
}
$conn->close();


               ?>
     </div>

     <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" loop="99999" style="position: absolute; left:375px"></marquee>
<script language="javascript">
 
function myFunction1() {


  

var div = document.getElementById("dom-target");
    var a = div.textContent;
    var arrStr = a.split(/[;]/);
//document.getElementById("demo").innerHTML=a;
          for(var i=0; i<arrStr.length-1; i+=2){

var arrStr1 = arrStr[i].split(/['\']/);

            
var img = document.createElement('img');
      

    img.src=arrStr1[0];
    img.width="150";
    img.height="240";
    img.alt =arrStr1[2];
    var link = document.createElement('a');
    link.href="moviepage.php?movieid="+arrStr[i+1];
    //link.href="mainpage.php?value_key=arrStr1[2]";
link.appendChild(img);

//document.getElementById('demo').innerHTML=arrStr[i];
   
/*var para = document.createElement("p");
var node = document.createTextNode(arrStr1[2]);
para.appendChild(node);*/
 // var d = document.createElement("FIGURE");

  //d.appendChild(link);
 //  d.appendChild(para);
 
//document.getElementById('fee').appendChild(d);
document.getElementById('fee').appendChild(link);


          }



    
}

 
</script>         
              
    </body>
</html>
