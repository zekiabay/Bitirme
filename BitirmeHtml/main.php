<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
</head>
	<body onload="myFunction1()">



		<script language="javascript">
 
function myFunction1() {


  

var div = document.getElementById("dom-target");
    var a = div.textContent;
    var arrStr = a.split(/[;]/);
//document.getElementById("demo").innerHTML=a;
          for(var i=0; i<arrStr.length-1; i++){

var arrStr1 = arrStr[i].split(/['\']/);

            
var img = document.createElement('img');
      

    img.src=arrStr1[0];
    img.width="150";
    img.height="240";
    img.alt=arrStr1[2];
    var link = document.createElement('a');
    link.href="moviepage.php?movietitle="+arrStr1[2];
    //link.href="mainpage.php?value_key=arrStr1[2]";


//document.getElementById('demo').innerHTML=arrStr[i];
   
  link.appendChild(img);
document.getElementById('fee').appendChild(link);
//document.getElementById('fee').appendChild(link);


          }



    
}

 
</script>

		<?php  include "top.php"; ?>
	<div class="form">

<?php 
 session_start();
 include "connect.php"; 

(String)$a= $_SESSION['name'];
(String)$c= $_SESSION['surname'];

 ?>
 <h2><?php echo "Hosgeldiniz ".$a." ".$c;  ?></h2>
	</div>
	
	
		
<div id="dom-target" style="display: none;">
    <?php 
    


if (!@$conn=mysqli_connect("127.0.0.1","root","","mrs")){
    die("Mysql'e bağlantı kurulamadı!".mysqli_error());
}


$sql = "SELECT title, poster_path FROM movietable LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
  
$path="https://image.tmdb.org/t/p/original".$row['poster_path'];

echo $path."'\'".$row['title'].";";
    }
} else {
    echo "0 results";
}

$conn->close();


    ?>
</div>
<br>
<br>
<br>
<marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" loop="99999"></marquee>
<div id="demo"></div>
</body>
</html>