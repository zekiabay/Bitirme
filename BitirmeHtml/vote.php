<!DOCTYPE html>
<html>
<head>
	<title>Vote</title>
	<link rel="stylesheet" type="text/css" href="vote.css">
</head>
<body>
	<?php 
 if(isset($_POST['req5'])){
            $title = $_POST['req5'];
 }elseif(isset($_POST['reqmark'])){
            $title = $_POST['reqmark'];
 }elseif(isset($_POST['reqchange'])){
            $title = $_POST['reqchange'];
 }
             ?>
	<h1><?php echo $title; ?></h1>
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
    <input type="hidden" name="req5" id="hiddenField" value="<?php echo $title ?>" />
</fieldset><button type="submit" id="rate" >Rate</button></form>
</body>
</html>