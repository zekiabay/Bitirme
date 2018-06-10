<?php 
        include "connect.php";
 session_start();

        $fromemail = $_SESSION['email'];
                $comment_id = $_POST['comment_id'];
                $value = $_POST['value'];
       // $fromemail = "gorhem@gmail.com";
              /*  $comment_id = 19;


                $value = 0;*/





                if($value==1){
                  $flag=0; 
                   $re = mysqli_query($conn,"SELECT commentlikes FROM comment WHERE comment_id=$comment_id");
                     $rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['commentlikes']);

                    for($i=0;$i<count($arr);$i++){

    $arr1 = explode("/", $arr[$i]);
         
if($arr1[0]==$fromemail){
    $flag=1;

    if($arr1[1]=="0"){
      $arr[$i]=  $fromemail."/1"; 

$new=implode(",", $arr);
$sorgu="UPDATE comment set comment_point= comment_point+2, commentlikes ='$new' where comment_id= $comment_id";
mysqli_query($conn,$sorgu);
        }
      elseif($arr1[1]=="1"){
unset($arr[$i]);
$new=implode(",", $arr);
$sorgu="UPDATE comment set comment_point= comment_point-1, commentlikes ='$new' where comment_id= $comment_id";
mysqli_query($conn,$sorgu);
      }


    }
}
                    
     if($flag==0){

                    $push=  $fromemail."/1"; 
                    array_push($arr,$push);
                    $new= implode(",", $arr);
                    $sorgu="UPDATE comment set comment_point= comment_point+1, commentlikes ='$new' where comment_id= $comment_id";
                    mysqli_query($conn,$sorgu);
    }

                  

}
elseif($value==0){
  
$flag=0;
 $re = mysqli_query($conn,"SELECT commentlikes FROM comment WHERE comment_id=$comment_id");
                   $rearray = mysqli_fetch_array($re);
 $arr = explode(",", $rearray['commentlikes']);

                    for($i=0;$i<count($arr);$i++){
    $arr1 = explode("/", $arr[$i]);
if($arr1[0]==$fromemail){
  $flag=1;
    if($arr1[1]=="1"){
      
      $arr[$i]=  $fromemail."/0"; 

$new=implode(",", $arr);
$sorgu="UPDATE comment set comment_point= comment_point-2, commentlikes ='$new' where comment_id= $comment_id";
mysqli_query($conn,$sorgu);
        }
      elseif($arr1[1]=="0"){
unset($arr[$i]);
$new=implode(",", $arr);
$sorgu="UPDATE comment set comment_point= comment_point+1, commentlikes ='$new' where comment_id= $comment_id";
mysqli_query($conn,$sorgu);
      }


    }
               
    
}
  


if($flag==0){
       $push=  $fromemail."/0"; 
                    array_push($arr,$push);
                    $new= implode(",", $arr);
                    $sorgu="UPDATE comment set comment_point= comment_point-1, commentlikes ='$new' where comment_id= $comment_id";
                    mysqli_query($conn,$sorgu);
}









                }










       
             ?>