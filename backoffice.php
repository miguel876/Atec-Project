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
</div>
</div>
<div class="row full">
  <div class="col-3 sidebar">
    <nav class="nav flex-column">
      <a class="nav-link" href="index.php?page=2">Gestão Pedidos</a>
      <a class="nav-link" href="index.php?page=7">Gestão Usuários</a>
      <a class="nav-link" href="index.php?page=11">Registar novo user</a>
    </nav>

</div>
<div class="col-9 bg-secondary">

  <div class="card" style="width: 75rem; height: 50rem;">
<div class="row">
  <div class="col-3 ml-3">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Diretor</h4>
        <p class="card-text">
          <?php
          include 'database/conn.php';
            $sql="SELECT id, firstname, lastname, email FROM utilizadores WHERE type='2'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) >0){
              while($row= mysqli_fetch_assoc($result)){
                echo $row["firstname"]." ".$row["lastname"]."<br><h6 class='card-subtitle mb-2 text-muted'>".$row["email"]."</h6>";

              echo "</p>
              <a href='index.php?page=8&ped=$row[id]' class='card-link''>Informação</a>";

}}
include 'database/disc.php';
 ?>
      </div>
    </div>
</div>
</div>


</div><!-- end card -->
</div>
</div>

<?php
include 'footer.php';
  ?>


</div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>

</html>
