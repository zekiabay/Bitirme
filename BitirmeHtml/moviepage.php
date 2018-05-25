<!DOCTYPE html>
<html>
	<head>
    <meta charset="UTF-8">
    <title>Movie Page</title>
<link rel="stylesheet" type="text/css" href="index.css">
    

    <style type="text/css">
      .margin{
       margin-left: 450px;
      }

    </style>
    </head>

    <body onload="myFunction1()">
        <?php  include "top.php"; ?>
   		 
    	<?php 
        session_start();
        include "connect.php"; 
    	$fromemail = $_SESSION['email'];
        	$title = $_GET['movietitle'];
             $sorgu1=mysqli_query($conn,"SELECT * FROM movietable
              WHERE title = '$title'");
             $result1=mysqli_fetch_array($sorgu1);
              	?>
<h1><?php echo $result1['title'] ?></h1> 
<div > <?php echo '<img style="float:left;" width="25%" height="25%" src="https://image.tmdb.org/t/p/original'.$result1['poster_path'].'">';?>    </div>
             
<div class="margin" >               <h2><?php echo $result1['tagline'] ?></h2>  
                    <h5>Year: <?php echo $result1['release_date'] ?></h4>  
                    <h4>Language: <?php echo $result1['language'] ?></h4>  
                    <p><?php echo $result1['overview'] ?></p>                     
           
</div>
                  
              <?php
              $cond =1;
              $cond2 = 1;
              /*$title = $_POST['movietitle'];
              $fromemail = $_SESSION['email'];*/
              $query=mysqli_query($conn,"SELECT movie_rate, user_movie from movie where user_mail='$fromemail' and user_movie='$title'");
              $query2=mysqli_query($conn,"SELECT vote_average,vote_count from movietable where title='$title'");
              //echo "title".$title."mail".$fromemail;
              if(mysqli_num_rows($query)<=0)
              {
                $cond =0;
              } 
              else{               
                $cond=1;    
                 $query1=mysqli_query($conn,"SELECT user_movie from movie where user_mail='$fromemail' and user_movie='$title'and status= 1");

              if(mysqli_num_rows($query1)<=0)
              {
                $cond2 =0;
              } 
              else{               
                $cond2=1;    
                           
              }     
              }
              //echo "cond".$cond." cond2".$cond2;
              ?>
   	  <?php if($cond==0): ?>
        <h3 class="margin">Average Vote: <?php $result=mysqli_fetch_array($query2);
            echo $result['vote_average'] ?></h3>
             <h4 class="margin">Vote Count: <?php 
            echo $result['vote_count'] ?></h4>
    	<div class="margin"> 
    	<form action="vote.php" method="post">           
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "req5" value = <?php echo $result1['title'] ?>/>Add Watched List</button>
            </form>
      </div>                
    <?php endif; ?>

    <?php if($cond==0): ?>
       
      <div class="margin"> 
      <form action="addmoviestowatch.php" method="post">           
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "reqwatch" value = <?php echo $result1['title'] ?>/>Add Movies to Watch List</button>
            </form>
      </div>  

    <?php endif; ?>

          <?php if($cond==1 && $cond2==0): ?>
            <h3 class="margin">Your Vote: <?php $result=mysqli_fetch_array($query);
            echo $result['movie_rate'] ?></h3>
            <h3 class="margin">Average Vote: <?php $result=mysqli_fetch_array($query2);
            echo $result['vote_average'] ?></h3>
             <h4 class="margin">Vote Count: <?php 
            echo $result['vote_count'] ?></h4>
      <div class="margin"> 
      <form action="vote.php" method="post">           
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "reqchange" value = <?php echo $result1['title'] ?>/>Change Vote</button>

            </form>
      </div>   

          <?php endif; ?>

      <?php if($cond==1 && $cond2==1): ?>
        <h3 class="margin">Average Vote: <?php $result=mysqli_fetch_array($query2);
            echo $result['vote_average'] ?></h3>
      <div class="margin"> 
      <form action="vote.php" method="post">           
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "reqmark" value = <?php echo $result1['title'] ?>/>Mark as Watched</button>
            </form>
      </div>  

     <?php endif; ?>
     <br>

   <div class="margin">
     

<?php 
        include "connect.php"; 
        $movie_id = $result1['id'];
          
              $sorgu1=mysqli_query($conn,"SELECT * FROM comment
              WHERE movie_id = '$movie_id'");

             while($row1 = $sorgu1->fetch_assoc()) : 

              $userid = $row1['user_id'];
              $sorgu2=mysqli_query($conn,"SELECT user_name FROM user
              WHERE user_id = '$userid'");
              $resultname=mysqli_fetch_array($sorgu2);

              ?>

            <h6><?php echo $resultname['user_name'] ?> Says: </h6>
            <textarea><?php echo $row1['user_comment'] ?></textarea>
            
        
          

            <?php endwhile; ?>


   </div>
   <div class="margin">
     <form action = "comment.php" method = "POST">
       <textarea name="comm" placeholder="Enter Comment Here..." cols="40" rows="10"></textarea>
       <input type="hidden" name="movie_id" value=<?php echo $result1['id'] ?> >
       <button  type="submit">Send</button>
     </form>
     </div>
     <button onclick="goBack()">Go Back</button>
    <div id="dom-target" style="display: none;">
          <?php 
       
     
          $title = $_GET['movietitle'];

             $sorgu1=mysqli_query($conn,"SELECT id FROM movietable
              WHERE title = '$title'");
             $result1=mysqli_fetch_array($sorgu1);
             $id = $result1['id'];
              $sorgu2=mysqli_query($conn,"SELECT actor_id,actor_cha FROM movieactor
              WHERE movie_id = '$id'");
             //$result1=mysqli_fetch_array($sorgu2);
          while($row1 = $sorgu2->fetch_assoc()){
    $actorid =$row1['actor_id'];
   
  $sqlreg2 =  mysqli_query($conn,"SELECT  actor_name,actor_poster  FROM actor WHERE actor_id = '$actorid'");
     $res2=mysqli_fetch_array($sqlreg2);
    $name = $res2['actor_name'];
    $poster = $res2['actor_poster'];
      echo $name."'\'".$row1['actor_cha']."'\'".$poster."'\'".$actorid.";";

    }

               ?>
     </div>
<br>
<br>
<br>
     <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" loop="99999"></marquee>
<script language="javascript">

function goBack() {
    window.history.back();
}

 
function myFunction1() {


  

var div = document.getElementById("dom-target");
    var a = div.textContent;
    var arrStr = a.split(/[;]/);
//document.getElementById("demo").innerHTML=a;
          for(var i=0; i<arrStr.length-1; i++){

var arrStr1 = arrStr[i].split(/['\']/);

            
var img = document.createElement('img');
      

   img.src="https://image.tmdb.org/t/p/original"+arrStr1[4];
  // img.src= "https://image.tmdb.org/t/p/original/7CcoVFTogQgex2kJkXKMe8qHZrC.jpg";
    img.width="150";
    img.height="240";
    img.alt=arrStr1[0];
    var link = document.createElement('a');
    link.href="actorpage.php?actor_id="+arrStr1[6];
    //link.href="mainpage.php?value_key=arrStr1[2]";


//document.getElementById('demo').innerHTML=arrStr[i];
   
  link.appendChild(img);
  var para = document.createElement("p");
var node = document.createTextNode("Name: "+arrStr1[0]+"<br> Character: "+arrStr1[2]);
para.appendChild(node);
 // var d = document.createElement("FIGURE");

  //d.appendChild(link);
  // d.appendChild(para);
 
//document.getElementById('fee').appendChild(d);
document.getElementById('fee').appendChild(link);


          }



    
}

 
</script>
  		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    	<script src="js/index.js"></script>   
    </body>
</html>
