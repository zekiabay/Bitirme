<!DOCTYPE html>
<html>
<head>
  <title></title>
    <meta charset="UTF-8">
  <title>Profile</title>



</head>
<body onload="myFunction1()">

<script language="javascript">
 




function myFunction1() {


  

var div = document.getElementById("dom-target");
    var a = div.textContent;
    var arrStr = a.split(/[;]/);

          for(var i=0; i<arrStr.length; i++){


            
var img = document.createElement('img');
      

    img.src=arrStr[i];
    img.width="135";
    img.height="240";
    
document.getElementById('demo').innerHTML=arrStr[i];
   
  
document.getElementById('fee').appendChild(img);


          }



    
}

 
</script>

<div id="dom-target" style="display: none;">
    <?php 
    


if (!@$conn=mysqli_connect("127.0.0.1","root","","movierecommend")){
    die("Mysql'e bağlantı kurulamadı!".mysqli_error());
}


$sql = "SELECT title FROM movietable where title='Four Rooms'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    )
);  



$veri = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=1e33709a11d776e5fae00b8144b2fea2&query=".str_replace(' ', '+', $row['title']), false, stream_context_create($arrContextOptions));
$json_input = json_decode($veri);
$jsoner = $json_input->{'results'}[0]->{'poster_path'};

$path="https://image.tmdb.org/t/p/original".$jsoner;

echo $path." ;";








    }
} else {
    echo "0 results";
}

$conn->close();


    ?>
</div>


<marquee id='fee' onmouseover="this.stop()" onmouseout="this.start()" 
 direction="horizontal" scrollamount="10" 
scrolldelay="60" loop="99999" >
   
</marquee>
<div id="demo"></div>
</body>
</html>