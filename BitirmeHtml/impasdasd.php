<?php
include "connect.php"; 
ini_set("max_execution_time", 0);

function todatabase($data,$conn){


      $json = json_encode($data, true);
      $js = json_decode($json, true);
     $arr = array();

preg_match_all("/\[(.*?)\]/", $js[0], $matches);
$a=$matches[1][0];
preg_match_all("/\{(.*?)\}/", $matches[1][0], $matches1);

    for ($j=0; $j < count($matches1[1]); $j++) { 

      $b = $matches1[1][$j];
    $parts = explode(",", $b);

    for ($i=0; $i < count($parts); $i++) { 
$par = explode(":", $parts[$i]);
  
if($i==1 && $par[1]){
$arr[0]= $par[1];

}
else if($i==4 && $par[1]){
  $arr[1]= $par[1];
}
if($i==5 && $par[1]){
$arr[3]= $par[1];

}
else if($i==7 && $par[1]){
  $arr[4]= $par[1];
}
  
    }
    $arr[0] = trim(str_replace('}', '', $arr[0]));
	$arr[0] = trim(str_replace('"','', $arr[0]));
	$arr[0] = trim(str_replace('"','', $arr[0]));
	$arr[0] = trim(str_replace('\'','', $arr[0]));
	 $arr[3] = trim(str_replace('}', ' ', $arr[3]));
	$arr[3] = trim(str_replace('"','', $arr[3]));
	$arr[3] = trim(str_replace('"','', $arr[3]));
	$arr[3] = trim(str_replace('\'','', $arr[3]));
	 $arr[4] = trim(str_replace('}', ' ', $arr[4]));
	$arr[4] = trim(str_replace('"','', $arr[4]));
	$arr[4] = trim(str_replace('"','', $arr[4]));
	$arr[4] = trim(str_replace('\'','', $arr[4]));
    $arr[2]= $js[2];
   /* $sql=" INSERT INTO movieactor (movie_id, actor_id, actor_cha) VALUES ('$arr[2]', '$arr[1]', '$arr[0]')";
  mysqli_query($conn, $sql);*/
   $sql1=" INSERT INTO actor (actor_id, actor_name, actor_poster) VALUES ('$arr[1]', '$arr[3]', '$arr[4]')";
  mysqli_query($conn, $sql1);
  }
}

if (($handle = fopen("credits.csv", "r")) !== FALSE) {
  
 $partdata = array("");
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {  
    if(count($data) != 3){
        $partdata[count($partdata)-1] = $partdata[count($partdata)-1].$data[0];
        for($c=1; $c<count($data) ;$c++){
          $partdata[count($partdata)] = $data[$c];

        }

        if(count($data) == 3){
          todatabase($data,$conn);
          $data = array("");
        }
      }else{
        todatabase($data,$conn);

      }
     }
   fclose($handle);
 }
?>