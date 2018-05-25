<?php
include "connect.php"; 
ini_set("max_execution_time", 0);
function todatabase($data,$conn){
  echo "<br>".count($data)."<br>";

  for($c=0; $c<count($data) ;$c++){
    echo " ".$data[$c];       
  }
  echo "<br><br>";

$parts = explode("'", $data[9]);
$overview = $parts[0];
for($c=1; $c<count($parts) ;$c++){
$overview .= "''".$parts[$c];

}
$parts = explode("'", $data[19]);
$tagline = $parts[0];
for($c=1; $c<count($parts) ;$c++){
$tagline .= "''".$parts[$c];
  
}
$parts = explode("'", $data[20]);
$title = $parts[0];
for($c=1; $c<count($parts) ;$c++){
$title .= "''".$parts[$c];

}

            $sql=" INSERT INTO movietable (id, title, language, overview, poster_path, release_date, revenue, runtime, tagline, vote_average, vote_count, adult, budget, imdb_id) VALUES ('$data[5]', '$title ', '$data[7] ', '$overview', '$data[11]', '$data[14]', '$data[15]', '$data[16]', '$tagline', '$data[22]', '$data[23]', '$data[0]', '$data[2]', '$data[6]')";

            if (mysqli_query($conn, $sql)) {
   

} else {
   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
       
       
}
if (($handle = fopen("movies_metadata.csv", "r")) !== FALSE) {
    $a = 1;
    $partdata = array("");
    while (($data = fgetcsv($handle, 40000, ",")) !== FALSE) {
      if(count($data) < 24){
        
        $partdata[count($partdata)-1] = $partdata[count($partdata)-1].$data[0];
        for($c=1; $c<count($data) ;$c++){
          $partdata[count($partdata)] = $data[$c];

        }

        echo "<br>TEST".count($data)." - ".count($partdata)."<br>";
       
        if(count($partdata) >= 24){
          todatabase($partdata,$conn);
          $partdata = array("");
        }

      }else{
        todatabase($data,$conn);

      }
    }
    fclose($handle);
}
?>