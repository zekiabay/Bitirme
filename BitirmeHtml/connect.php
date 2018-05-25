<?php
if (!@$conn=mysqli_connect("127.0.0.1","root","","mrs")){
    die("Mysql'e bağlantı kurulamadı!".mysqli_error());
}
?>﻿