<!DOCTYPE html>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Search</title>
<link rel="stylesheet" type="text/css" href="index.css">

    </head>
    <body>
        <?php  include "top.php"; ?>
      <?php 

       session_start();
        include "connect.php"; 
        if(isset($_POST['search'])) : ?>

        <?php 
        $cond = "";
       
        if($_POST['title']) : 
          $title = $_POST['title'];
          $title="%".$title."%";
          $cond = "title LIKE '$title'";
          endif;



          if($_POST['actor']) {  
          $actor = $_POST['actor'];
            $actor="%".$actor."%";
           $actorsorgu=mysqli_query($conn,"SELECT actor_id FROM actor
              WHERE actor_name LIKE '$actor'");
            // $actorresult=mysqli_fetch_array($actorsorgu);
            // $acid = $actorresult['actor_id'];
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
             



             //  $actormoviesorguarray=mysqli_fetch_array($actormoviesorgu);
          }else{
             
               //$actormoviesorguarray=mysqli_fetch_array($actormoviesorgu);

               $actorarray=[];
      

          }





           if($_POST['year']) :  
          $year = $_POST['year'];
          if($cond == ""){
            $cond = "release_date = '$year'";
          }else{
            $cond = "$cond AND release_date = '$year'";
          }
          endif;
           if($_POST['language']) :  
          $language = $_POST['language'];
          if($cond == ""){
            $cond = "language = '$language'";
          }else{
            $cond = "$cond AND language = '$language'";
          }
          endif;



           if($_POST['productor']){
          $production = $_POST['productor'];
           $production="%".$production."%";
          $productionsorgu=mysqli_query($conn,"SELECT production_id FROM production
              WHERE production_name LIKE '$production'");
              $productionarray =[];
             $ind1=0;
             while($r1 = $productionsorgu->fetch_assoc()){
               # code...
                $prodid=$r1['production_id'];
               $productionmoviesorgu=mysqli_query($conn,"SELECT DISTINCT(movie_id) FROM movieproduction
              WHERE production_id = '$prodid'");
               // $act=mysqli_fetch_array($actormoviesorgu);
                   while($ro1 = $productionmoviesorgu->fetch_assoc()){
             $productionarray[$ind1]=$ro1['movie_id'];
             //echo $s1[$a]." ";
              $ind1++;
          }
               
             }
           }else{


               $productionarray=[];
     

           }





           if($_POST['minrate']) :  
          $minrate = $_POST['minrate'];
          if($cond == ""){
            $cond = "vote_average >= $minrate AND vote_count>=10";
          }else{
            $cond = "$cond AND vote_average >= $minrate AND vote_count>=10";
          }
          endif;
           if($_POST['maxrate']) :  
          $maxrate = $_POST['maxrate'];
          if($cond == ""){
            $cond = "vote_average <= $maxrate AND vote_count>=10";
          }else{
            $cond = "$cond AND vote_average <= $maxrate AND vote_count>=10";
          }
          endif;




             if($_POST['category']){
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
               // $act=mysqli_fetch_array($actormoviesorgu);
                   while($ro2 = $categorymoviesorgu->fetch_assoc()){
             $categoryarray[$ind2]=$ro2['movie_id'];
             //echo $s1[$a]." ";
              $ind2++;
          }
               
             }
          }else{
          

               $categoryarray=[];
    
          }




          if($cond == ""){
            $sorgu=mysqli_query($conn,"SELECT DISTINCT(id) FROM movietable ");
             //$sorguarray=mysqli_fetch_array($sorgu);
          }else{

             
            $sorgu=mysqli_query($conn,"SELECT DISTINCT(id) FROM movietable WHERE $cond");
           // $sorguarray=mysqli_fetch_array($sorgu);

          }
          $s1=[];
          $a=0;
          while($row1 = $sorgu->fetch_assoc()){
             $s1[$a]=$row1['id'];
             //echo $s1[$a]." ";
              $a++;
          }
        /* $s2=[];
          $b=0;
          while($row2 = $actormoviesorgu->fetch_assoc()){
          if($_POST['actor']){   
             $s2[$b]=$row2['movie_id'];
             echo $s2[$b]." ";
           }
                else{
$s2[$b]=$row2['id'];
              }
            // echo $s2[$b]." ";
              $b++;
          }*/
        /*  $s3=[];
          $c=0;
          while($row3 = $categorymoviesorgu->fetch_assoc()){
           
if($_POST['category']){
            $s3[$c]=$row3['movie_id'];}
              else{
$s3[$c]=$row3['id'];
              }
            
           // echo $s3[$c]." ";
              $c++;
          }
          $s4=[];
          $d=0;
          while($row4 = $productionmoviesorgu->fetch_assoc()){
             if($_POST['productor']){
               $s4[$d]=$row4['movie_id'];}
               else{
                 $s4[$d]=$row4['id'];
               }

              $d++;
          }*/
if($actorarray && $categoryarray && $productionarray){
          $sonuc = array_intersect($s1, $actorarray);
          $sonuc1 = array_intersect($sonuc,$categoryarray);
          $sonuc2 = array_intersect($sonuc1, $productionarray);}
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
           elseif(!$actorarray && !$categoryarray && $productionarray){
$sonuc1 = array_intersect($s1,$productionarray);
          $sonuc2 = array_intersect($sonuc1, $actorarray);
          }else{
            $sonuc2=$s1;
          }
//print_r($sonuc);
//echo $s2[0]." ";
//echo "string".$sonuc2[0]." ";
//echo "string".$s4[0]." ";
          
          if (count($sonuc2) > 0) :?>
          <h1>Search Results:</h1>
          <div class="form">
          <?php foreach ($sonuc2 as $key => $value) 
            # code...
            :

//$a=$actorarray[$i];
 $fetch=mysqli_query($conn,"SELECT title FROM movietable WHERE id='$value'");
$fetcharray=mysqli_fetch_array($fetch);
//echo $sonuc2[$i];
           ?>
              
            <form action="moviepage.php" method="get">          
            <button style="margin-bottom: 2px; width: 200px" type="submit" name = "movietitle"  value = <?php echo '"'.$fetcharray['title'].'"' ?> class="btn"  /> <?php echo $fetcharray['title'] ?> </button>

            </form>
            <?php endforeach;?>



            <h2></h2>
            <form action="searchoffers.php" method="post">          
            <button type="submit"/>New Search</button>
            </form>
            </div>

             <?php else:?>
             <h1>Search Results:</h1>

             <div class="form">
             <h2>No Result!!</h2>
             <form action="searchoffers.php" method="post">          
            <button type="submit"/>New Search</button>
            </form>


             </div>
            <?php endif;
        ?>   
      <?php else:?> 
      <h1 align="center">Search</h1>
       <div class="form" align="center">
        <form action="" method="post" >       

             <div class="field-wrap">
              <label>
                Movie Title<span class="req"></span>
              </label>
              <input type="text" name="title"  />
            </div>

            <div class="field-wrap">
              <label>
                Actor<span class="req"></span>
              </label>
              <input type="text" name="actor"  />
            </div>

            <div class="field-wrap">
              <label>
               Year<span class="req"></span>
              </label>
              <input type="text" name="year"  />
            </div>

            <div class="field-wrap">
              <label>
                Language<span class="req"></span>
              </label>
              <input type="text" name="language"  />
            </div>

            <div class="field-wrap">
              <label>
                Productor<span class="req"></span>
              </label>
              <input type="text" name="productor"  />
            </div>

            <div class="field-wrap">
              <label>
                Min Rate<span class="req"></span>
              </label>
              <input type="text" name="minrate"  />
            </div>
            <div class="field-wrap">
              <label>
                Max Rate<span class="req"></span>
              </label>
              <input type="text" name="maxrate"  />
            </div>

            <div class="field-wrap">
              <label>
                Category<span class="req"></span>
              </label>
              <input type="text" name="category"  />
            </div>
          
            <button type="submit" name="search"/>Search</button>
        </form>
        
        </div>

      <?php endif; ?>
    </body>
</html>