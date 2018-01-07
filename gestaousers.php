<?php
if(@$_SESSION["type"]=='4'){
  include 'database/conn.php';
    echo "<nav class='nav nav-tabs' id='myTab' role='tablist'>
      <a class='nav-item nav-link active text-primary' id='normal' data-toggle='tab' href='#nav-normal' role='tab' aria-controls='nav-home' aria-selected='true'>Formadores</a>
      <a class='nav-item nav-link text-primary' id='recursos' data-toggle='tab' href='#nav-recursos' role='tab' aria-controls='nav-profile' aria-selected='false'>Recursos Humanos</a>

  ";
  echo "<a href='backoffice.php' class='nav-item nav-link text-primary text-dark'>Voltar</a>";

      echo "</nav><div class='tab-content' id='nav-tabContent'><div class='tab-pane fade show active' id='nav-normal' role='tabpanel' aria-labelledby='normal'>";

    //Usuário Normal
    $sql="SELECT id, firstname, lastname, email FROM utilizadores WHERE type='1' AND isDeleted='0' ORDER BY id DESC";
    $result= mysqli_query($conn, $sql);

    echo "<table class='table table-hover'>";
    if(mysqli_num_rows($result) >0){
      while($row= mysqli_fetch_assoc($result)){

        echo "<tr><td><a href=index.php?page=8&ped=".$row["id"]." class='text-primary'>".$row["firstname"]."</a></td><td>".$row["lastname"]."</td><td>".$row["email"]."</td></tr>";
      }

    }
    echo "</table></div>";

    echo "<div class='tab-pane fade' id='nav-recursos' role='tabpanel' aria-labelledby='recursos'>";
    //Usuário R.H.
    $sql="SELECT id, firstname, lastname, email FROM Utilizadores WHERE type='3' AND isDeleted='0' ORDER BY id DESC";
    $result= mysqli_query($conn, $sql);

    echo "<table class='table table-hover'>";
    if(mysqli_num_rows($result) >0){
      while($row= mysqli_fetch_assoc($result)){

        echo "<tr><td><a href=index.php?page=8&ped=".$row["id"]." class='text-primary'>".$row["firstname"]."</a></td><td>".$row["lastname"]."</td><td>".$row["email"]."</td></tr>";
      }

    }
    echo "</table></div>";


  include 'disc.php';

  }

 ?>
