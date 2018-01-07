<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Atec Form</title>
</head>

<body>
  <div class="container-fluid">
  <div class="row">
    <div class="col-xl">
  <?php

  session_start();

include 'header.php';

  ?>
<form method="post">
<div id="card">
<div class="card" style="width: 20rem;">
  <div class="card-body">
    <h4 class="card-title">Login</h4>
    <p class="card-text">
    <input type="text" name="username" placeholder=" Username" class="form-control mt-1">
    <input type="password" name="password" class="form-control mt-1">
    <input type="submit" name="login" value="Entrar" class="btn btn-outline-primary btn-sm mt-2 w-100" ></p>
  </div>
</div>
</div>
</form>

<?php

if(isset($_POST["login"])){

  include 'database/conn.php';

  if(empty($_POST["username"]) || empty($_POST["password"])){
    echo 'Empty Username or Password';
  }
  else{
  $sql=mysqli_query($conn, "SELECT id, username, password, firstname, lastname, type, isDeleted FROM utilizadores WHERE username='$_POST[username]' and password='$_POST[password]'");
  $users= mysqli_fetch_array($sql);
 if(!$users){
   echo 'Dados Errados!';
 }
 else if($users["isDeleted"]=='1'){
   echo 'A sua conta foi apagada!';
 }
 else{
   $name= $users["firstname"] ." ". $users["lastname"]  ;

   $_SESSION["id"]= $users["id"];
   $_SESSION["username"]= $users["username"];
   $_SESSION["type"]= $users["type"];
   $_SESSION["name"]=  $name;

if($_SESSION["type"]=='2'){
  $_SESSION["warn"]='0';
}
   include 'database/disc.php';
   if($_SESSION["type"]=='4'){
      echo '<meta http-equiv="refresh" content="0;url=backoffice.php">';
   }else{
   echo '<meta http-equiv="refresh" content="0;url=index.php?page=2">';
}
 }
  }
}
include 'footer.php';
 ?>

</div>
</div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>

</html>
