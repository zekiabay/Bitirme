<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="top.css">
<link rel="stylesheet" type="text/css" href="index.css">
<style type="text/css">
	
	body{
    background-image: url('4.jpg');
    background-size: 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;

}
}
input{
	    position: absolute;
	    left: 180px;
}

</style>
</head>
	<body>
	
	<?php 
session_start();
include "connect.php"; 
if(isset($_POST['name'])){
	$name = $_POST["name"];
	$language = $_POST["language"];
	$overview = $_POST["overview"];
	$date = $_POST["date"];
	$tagline = $_POST["tagline"];
	$runtime = $_POST["runtime"];

	 $sql = "INSERT INTO movietable (title, language, overview ,release_date,tagline,runtime)
VALUES ('$name','$language','$overview','$date','$tagline','$runtime')";
mysqli_query($conn, $sql); 
}
?>

		<a href="admin.php"> <img src="Film-icon.png" width="40" height="40" class="logo">
		<p class="logotext">Movie Recommendation System</p></a>
		<header class="register">
 			<a href="admin.php" class="log">Add Movie</a>
			<a href="logout.php" class="log">Logout</a>
		</header>
		<br>
		<div align="center">
			<h3>Add Movie</h3>
		<form action="admin.php" method="post" class="form">
		<p><label class="label" for="name">Movie's Name:</label> 
		<input id="fname" type="text" name="name" size="30" maxlength="30"></p>
		<p><label class="label" for="phone">Language:</label>
		<input id="lname" type="text" name="language" size="30" maxlength="40" ></p>
		<p><label class="label" for="age">Overview:</label>
		<textarea id="lname" type="number" name="overview" cols="27" rows="3" placeholder="Overview..."></textarea></p>

		<p><label class="label" for="email">Release Date:</label>
		<input id="email" placeholder="0000-00-00" type="text" name="date" size="30" maxlength="60" > </p>
		<p><label class="label" for="gender">Tagline:</label>
		<input id="text" type="text" name="tagline" size="12" maxlength="12"></p>
		<p><label class="label" for="gender">Runtime:</label>
		<input id="text"  type="text" name="runtime" size="12" maxlength="12"></p>

<p><input  style="margin-bottom: 2px; width: 200px"  id="submit" type="submit" name="submit" value="Add Movie"></p>
</form>
</div>

	</body>
</html>
