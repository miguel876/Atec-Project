<?php
$servername="localhost";
$username="root";
$password="";
$conn= mysqli_connect($servername, $username, $password);

if(!$conn){
  die("Erro de ligação".mysql_connect_error());
}
mysqli_select_db($conn,"atecform");
mysqli_set_charset($conn,'utf-8');
 ?>
