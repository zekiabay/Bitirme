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
    <title>Movie Page</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="vote.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
button{
  background-color: #99ff99;
  color:black;
}
    .fa {
    font-size: 15px;
    cursor: pointer;
  
}

.fa:hover {
  color: darkblue;
}
      .comme{
 
       overflow: auto;
       width: 350px;
       height: 500px;
      }
      .over{
        width: 500px;
        margin-left: 450px;   
          
      }
      .marq{
        float: right;

      }
      .margin{
       margin-left: 450px;
     }
.show{
  display: block;
}
.ss{
  display: none;
}
.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}
.tip-right {
  top: 10px;
  right: -25px;
  border-top-color: transparent;
  border-right-color: transparent;
  border-bottom-color: transparent;  
}
.dialogbox .body {
  position: relative;
  max-width: 300px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #F8F8FF;
  border-radius: 3px;
  border: 5px solid #ccc;
}

.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1;
  color: #797979;
}
body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
    </style>
    </head>

    <body >
        <?php  include "top.php";

        include "connect.php"; 
    	$fromemail = $_SESSION['email'];
        	$movid = $_GET['movieid'];
             $sorgu1=mysqli_query($conn,"SELECT * FROM movietable
              WHERE id = '$movid'");
             $result1=mysqli_fetch_array($sorgu1);
              	?>

<h1><?php echo $result1['title'] ?></h1> 
<?php if ($result1['poster_path']): ?>
  <div > <?php echo '<img style="float:left;" width="25%" height="25%" src="https://image.tmdb.org/t/p/original'.$result1['poster_path'].'">';?>    </div>

<?php else: ?>
 <div > <?php echo '<img style="float:left;" width="25%" height="25%" src="default.jpg">';?>    </div>


<?php endif; ?>
 <div class="comme" style="float: right;">
     <form  action = "comment.php" method = "POST">
       <textarea name="comm" style="margin-left: 10px; margin-top:5px; border-color: #ccc; border-width: 5px; border-style:solid;" placeholder="Enter Comment Here..." cols="27" rows="3"></textarea>
       <input type="hidden" name="movie_id" value=<?php echo $result1['id'] ?> >
       <button style="margin-top:19px; vertical-align: top;" type="submit">Send</button>
     </form>

     

<?php 
        $movie_id = $result1['id'];
          
              $sorgu1=mysqli_query($conn,"SELECT * FROM comment
              WHERE movie_id = '$movie_id' ORDER BY comment_point DESC ");

             while($row1 = $sorgu1->fetch_assoc()) : 

              $userid = $row1['user_id'];
              $sorgu2=mysqli_query($conn,"SELECT user_name FROM user
              WHERE user_id = '$userid'");
              $resultname=mysqli_fetch_array($sorgu2);

              ?>

   <?php
  $fromemail = $_SESSION['email'];
$comment_id=$row1['comment_id'];
 $re = mysqli_query($conn,"SELECT commentlikes FROM comment WHERE comment_id=$comment_id");
                      $rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['commentlikes']);
$flag1=0;
                    for($i=0;$i<count($arr);$i++){
    $arr1 = explode("/", $arr[$i]);
if($arr1[0]==$fromemail){
    
    if($arr1[1]=="0"){
      $flag1=1;
   

        }
      elseif($arr1[1]=="1"){
        $flag1=2;


      }


    }
}
$color1="black";
$color0="black";
if($flag1==1){
$color0="red";
}elseif($flag1==2){
$color1="green";

}

?>

 <div class="dialogbox">
    <div class="body">
      <span class="tip tip-right"></span>
      <div class="message">
       <i style="float: right; color: <?php echo $color0; ?>" onclick="comment(this)" class="fa fa-thumbs-down"> <?php echo $row1['comment_point']?></i> 
       <i style="float:right; color: <?php echo $color1; ?>;" onclick="comment(this)" class="fa fa-thumbs-up"></i>
       
        <span id="<?php echo $row1['comment_id'] ?>"><h6 style="margin:0; "><?php echo $resultname['user_name'] ?> Says:  </h6><?php echo $row1['user_comment'] ?></span>
      </div>
    </div>
  </div>

            <?php endwhile; ?>


     </div>   
            <?php   $sorgu3=mysqli_query($conn,"SELECT category_name FROM category
              WHERE category_id IN (SELECT category_id FROM moviecategory
              WHERE movie_id = '$movid')");

        
             while($row3 = $sorgu3->fetch_assoc()){
        


             }
             





             ?>
                    <div class="over">
                      <h2><?php echo $result1['tagline'] ?></h2>  
                              <h4>Genres: <?php   $sorgu3=mysqli_query($conn,"SELECT category_name FROM category
              WHERE category_id IN (SELECT category_id FROM moviecategory
              WHERE movie_id = '$movid')");
        
             while($row3 = $sorgu3->fetch_assoc()){
        
              echo $row3['category_name']." ";

             }

             ?></h4>  
                    <h5> <?php if($result1['release_date']!='0000-00-00') echo "Year: ". $result1['release_date'];  ?></h4>  
                    <h4>Language: <?php echo $result1['language'] ?></h4>  

                    <p><?php echo $result1['overview'] ?></p>   
                    </div>
                                      
           
                  
              <?php
              $cond =1;
              $cond2 = 1;
              /*$title = $_POST['movietitle'];
              $fromemail = $_SESSION['email'];*/
          
              $id =$result1['id'];
              $query=mysqli_query($conn,"SELECT movie_rate, user_movieid from movie where user_mail='$fromemail' and user_movieid='$id'");
              $query2=mysqli_query($conn,"SELECT vote_average,vote_count from movietable where id='$movid'");
              //echo "title".$title."mail".$fromemail;
              if(mysqli_num_rows($query)<=0)
              {
                $cond =0;
              } 
              else{               
                $cond=1;    
                 $query1=mysqli_query($conn,"SELECT user_movieid from movie where user_mail='$fromemail' and user_movieid='$id'and status= 1");

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
             if ($result['vote_count']==0) {
                $avg=0;
             }
             else{
             $avg=$result['vote_average']/$result['vote_count']; 
           }
            // $avg = floor($avg * 2) / 2;
             echo round($avg,1);?></h3>
             <h4 class="margin">Vote Count: <?php 
            echo $result['vote_count'] ?></h4>

    	<div class="margin"> 
    	        
            <button onclick="rate()">Add to Watched List</button>
                <div class="ss" id="ss1">
<form action="addmovie.php" method="post">  <fieldset class="rating">
       <input type="radio" id="star10" name="rating" value="10" /><label class = "full" for="star10" title="Awesome - 10 stars"></label>
    <input type="radio" id="star9half" name="rating" value="9.5" /><label class="half" for="star9half" title="Pretty good - 9.5 stars"></label>
    <input type="radio" id="star9" name="rating" value="9" /><label class = "full" for="star9" title="Pretty good - 9 stars"></label>
    <input type="radio" id="star8half" name="rating" value="8.5" /><label class="half" for="star8half" title="Meh - 8.5 stars"></label>
    <input type="radio" id="star8" name="rating" value="8" /><label class = "full" for="star8" title="Meh - 8 stars"></label>
    <input type="radio" id="star7half" name="rating" value="7.5" /><label class="half" for="star7half" title="Kinda bad - 7.5 stars"></label>
    <input type="radio" id="star7" name="rating" value="7" /><label class = "full" for="star7" title="Kinda bad - 7 stars"></label>
    <input type="radio" id="star6half" name="rating" value="6.5" /><label class="half" for="star6half" title="Meh - 6.5 stars"></label>
    <input type="radio" id="star6" name="rating" value="6" /><label class = "full" for="star6" title="Sucks big time - 6 star"></label>
    <input type="radio" id="star5half" name="rating" value="5.5" /><label class="half" for="star5half" title="Sucks big time - 5.5 stars"></label>
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars">
    
    </label>
    <input type="hidden" name="req5" id="hiddenField" value="<?php echo $result1['id'] ?>" />
</fieldset><button type="submit" id="rate" >Rate</button></form>
<br>
<br>
<br>
           </div>
           <br>
      </div>                
    <?php endif; ?>

    <?php if($cond==0): ?>
       <br>
      <div class="margin"> 
      <form action="addmoviestowatch.php" method="post">           
            <button style="margin-bottom: 2px; width: 153.5px" type="submit" name = "reqwatch" value = "<?php echo $result1['id'] ?>"/>Watch Later</button>
            </form>
      </div>  

    <?php endif; ?>

          <?php if($cond==1 && $cond2==0): ?>
            <h3 class="margin">Your Vote: <?php $result=mysqli_fetch_array($query);
            echo $result['movie_rate'] ?></h3>
            <h3 class="margin">Average Vote: <?php $result=mysqli_fetch_array($query2);


            if ($result['vote_count']==0) {
                $avg=0;
             }
             else{
             $avg=$result['vote_average']/$result['vote_count']; 
           }

              echo round($avg,1);?></h3>
             <h4 class="margin">Vote Count: <?php 
            echo $result['vote_count'] ?></h4>
      <div class="margin"> 
              
            <button onclick="rate()">Change Vote</button>
              <form action="removemovie.php" method="post" >         
               <br> 
            <button style="margin-bottom: 2px; width: 180px margin-top: 2px;" type="submit" name = "movieid"  value = "<?php echo '"'.$movid.'"' ?>" />Remove Watched List</button>
            </form>

     <div class="ss" id="ss1">
<form action="addmovie.php" method="post">  <fieldset class="rating">
       <input type="radio" id="star10" name="rating" value="10" /><label class = "full" for="star10" title="Awesome - 10 stars"></label>
    <input type="radio" id="star9half" name="rating" value="9.5" /><label class="half" for="star9half" title="Pretty good - 9.5 stars"></label>
    <input type="radio" id="star9" name="rating" value="9" /><label class = "full" for="star9" title="Pretty good - 9 stars"></label>
    <input type="radio" id="star8half" name="rating" value="8.5" /><label class="half" for="star8half" title="Meh - 8.5 stars"></label>
    <input type="radio" id="star8" name="rating" value="8" /><label class = "full" for="star8" title="Meh - 8 stars"></label>
    <input type="radio" id="star7half" name="rating" value="7.5" /><label class="half" for="star7half" title="Kinda bad - 7.5 stars"></label>
    <input type="radio" id="star7" name="rating" value="7" /><label class = "full" for="star7" title="Kinda bad - 7 stars"></label>
    <input type="radio" id="star6half" name="rating" value="6.5" /><label class="half" for="star6half" title="Meh - 6.5 stars"></label>
    <input type="radio" id="star6" name="rating" value="6" /><label class = "full" for="star6" title="Sucks big time - 6 star"></label>
    <input type="radio" id="star5half" name="rating" value="5.5" /><label class="half" for="star5half" title="Sucks big time - 5.5 stars"></label>
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars">
    
    </label>
    <input type="hidden" name="req5" id="hiddenField" value="<?php echo $result1['id'] ?>" />
</fieldset><button type="submit" id="rate" >Rate</button></form>
           </div>
            <br>
<br>
<br>
      </div>   

          <?php endif; ?>

      <?php if($cond==1 && $cond2==1): ?>
        <h3 class="margin">Average Vote: <?php $result=mysqli_fetch_array($query2);
            
            if ($result['vote_count']==0) {
                $avg=0;
             }
             else{
             $avg=$result['vote_average']/$result['vote_count']; 
           }
              echo round($avg,1);?></h3>
      <div class="margin"> 
         
            <button onclick="rate()">Mark as Watched</button>
            <form action="removemovie.php" method="post" >       
             <br>   
            <button style="margin-bottom: 2px; margin-top: 2px; width: 180px" type="submit" name = "movieid"  value = "<?php echo '"'.$movid.'"' ?>" />Remove Watch Later</button>
            </form>

              <div class="ss" id="ss1">
<form action="addmovie.php" method="post">  <fieldset class="rating">
       <input type="radio" id="star10" name="rating" value="10" /><label class = "full" for="star10" title="Awesome - 10 stars"></label>
    <input type="radio" id="star9half" name="rating" value="9.5" /><label class="half" for="star9half" title="Pretty good - 9.5 stars"></label>
    <input type="radio" id="star9" name="rating" value="9" /><label class = "full" for="star9" title="Pretty good - 9 stars"></label>
    <input type="radio" id="star8half" name="rating" value="8.5" /><label class="half" for="star8half" title="Meh - 8.5 stars"></label>
    <input type="radio" id="star8" name="rating" value="8" /><label class = "full" for="star8" title="Meh - 8 stars"></label>
    <input type="radio" id="star7half" name="rating" value="7.5" /><label class="half" for="star7half" title="Kinda bad - 7.5 stars"></label>
    <input type="radio" id="star7" name="rating" value="7" /><label class = "full" for="star7" title="Kinda bad - 7 stars"></label>
    <input type="radio" id="star6half" name="rating" value="6.5" /><label class="half" for="star6half" title="Meh - 6.5 stars"></label>
    <input type="radio" id="star6" name="rating" value="6" /><label class = "full" for="star6" title="Sucks big time - 6 star"></label>
    <input type="radio" id="star5half" name="rating" value="5.5" /><label class="half" for="star5half" title="Sucks big time - 5.5 stars"></label>
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars">
    
    </label>
    <input type="hidden" name="req5" id="hiddenField" value="<?php echo $result1['id'] ?>" />
</fieldset><button type="submit" id="rate" >Rate</button></form>
           </div>

      </div>  

     <?php endif; ?>
     <br>


  
   <!--  <button onclick="goBack()">Go Back</button>-->
    <?php 
               
              $sorgu2=mysqli_query($conn,"SELECT actor_id,actor_cha FROM movieactor
              WHERE movie_id = '$movid'");
              if(mysqli_num_rows($sorgu2)>6):?>
        <marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60"   >
         <?php
          while($row1 = $sorgu2->fetch_assoc()){
    $actorid =$row1['actor_id'];
   
  $sqlreg2 =  mysqli_query($conn,"SELECT  actor_name,actor_poster  FROM actor WHERE actor_id = '$actorid'");
     $res2=mysqli_fetch_array($sqlreg2);
    $name = $res2['actor_name'];
    $poster = $res2['actor_poster'];
     // echo $name."'\'".$row1['actor_cha']."'\'".$poster."'\'".$actorid.";";
echo  '<a href="actorpage.php?actor_id='.$actorid.'"><img alt="'.$name.'" width="150" height="240" src="https://image.tmdb.org/t/p/original'. $poster.'">'  ;
    }

               ?>
    </marquee>
  <?php else:
   while($row1 = $sorgu2->fetch_assoc()){
    $actorid =$row1['actor_id'];
   
  $sqlreg2 =  mysqli_query($conn,"SELECT  actor_name,actor_poster  FROM actor WHERE actor_id = '$actorid'");
     $res2=mysqli_fetch_array($sqlreg2);
    $name = $res2['actor_name'];
    $poster = $res2['actor_poster'];
     // echo $name."'\'".$row1['actor_cha']."'\'".$poster."'\'".$actorid.";";
echo '<a href="actorpage.php?actor_id='.$actorid.'"><img alt="'.$name.'" width="150" height="240" src="https://image.tmdb.org/t/p/original'. $poster.'"></a>' ;
    }
  endif;
   ?>
<br>
<br>
<br>
<div class="marq">
 
</div>
<script language="javascript">

  function comment(x){
   
  var s = x.classList;
   if( s =="fa fa-thumbs-up"){
    var c =x.nextSibling.nextSibling;
   //document.getElementById("asd").innerHTML=c.id;
    var id = c.id; var val= 1;
    
       var input='comment_id='+ id+'&value='+val;
 
 $.ajax({ 
          type:'POST',  
          url:'commentvote.php',  
          data:input,  
          success: 
        function(cevap){ 
 location.reload();
        }

  });
}
   else{
    var c =x.nextSibling.nextSibling.nextSibling.nextSibling;
      var id = c.id; var val= 0;
       var input='comment_id='+ id+'&value='+val;
         
 $.ajax({ 
          type:'POST',  
          url:'commentvote.php',  
          data:input,  
          success: 
        function(cevap){ 
 location.reload();
        }
   });

}
}
function rate(){
  document.getElementById('ss1').style.display="block";
}
function goBack() {
    window.history.back();
}
 
function myFunction1() {

var div = document.getElementById("dom-target");
    var a = div.textContent;
    var arrStr = a.split(/[;]/);
          for(var i=0; i<arrStr.length-1; i++){

var arrStr1 = arrStr[i].split(/['\']/);
            
var img = document.createElement('img');
      
   img.src="https://image.tmdb.org/t/p/original"+arrStr1[4];
    img.width="150";
    img.height="240";
    img.alt=arrStr1[0];
    var link = document.createElement('a');
    link.href="actorpage.php?actor_id="+arrStr1[6];
  link.appendChild(img);
  var para = document.createElement("p");
var node = document.createTextNode("Name: "+arrStr1[0]+"<br> Character: "+arrStr1[2]);
para.appendChild(node);
document.getElementById('fee').appendChild(link);

          }  
}
</script>
  		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    	<script src="js/index.js"></script>   
    </body>
</html>
