<html>
<?php
if(@$_SESSION["id"]){
 ?>


<nav class="nav nav-tabs" id="myTab" role="tablist">
  <a class="nav-item nav-link active" id="pendentes" data-toggle="tab" href="#nav-pendentes" role="tab" aria-controls="nav-home" aria-selected="true">Pendentes</a>
  <a class="nav-item nav-link" id="aceites" data-toggle="tab" href="#nav-aceites" role="tab" aria-controls="nav-profile" aria-selected="false">Aceites</a>
  <a class="nav-item nav-link" id="recusados" data-toggle="tab" href="#nav-recusados" role="tab" aria-controls="nav-contact" aria-selected="false">Recusados</a>
</nav>
<div class="tab-content" id="nav-tabContent">
<div class="tab-pane fade show active" id="nav-pendentes" role="tabpanel" aria-labelledby="pendentes">

<?php
include 'database/conn.php';

//Pedidos pendentes---

$sql="SELECT id, data, nome, de, ate, das, ashoras, observacoes, obsdiretor FROM pedidos WHERE id_utilizador='$_SESSION[id]' AND estado='0'";
$result= mysqli_query($conn, $sql);
echo "<table class='table table-hover'>";
if(mysqli_num_rows($result) >0){
  while($row= mysqli_fetch_assoc($result)){

    echo "<tr><td><a href=index.php?page=5&ped=$row[id] class='text-primary'>".$row["nome"]."</a></td><td>".$row["de"]."</td><td>".$row["ate"]."</td><td>".$row["das"]."</td><td>".$row["ashoras"]."</td><td>".$row["data"]."</td></tr>";
  }
}

echo "</table>";
include 'database/disc.php';
 ?>

</div>
<div class="tab-pane fade" id="nav-aceites" role="tabpanel" aria-labelledby="aceites">
  <?php
  include 'database/conn.php';

  //Pedidos aceites---

  $sql="SELECT id, data, nome, de, ate, das, ashoras, observacoes, obsdiretor FROM pedidos WHERE id_utilizador='$_SESSION[id]' AND estado='1'";
  $result= mysqli_query($conn, $sql);
  echo "<table class='table table-hover'>";
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

      echo "<tr><td><a href=index.php?page=5&ped=$row[id] class='text-primary'>".$row["nome"]."</a></td><td>".$row["de"]."</td><td>".$row["ate"]."</td><td>".$row["das"]."</td><td>".$row["ashoras"]."</td><td>".$row["data"]."</td></tr>";
    }
  }

  echo "</table>";
  include 'database/disc.php';
   ?>

</div>
<div class="tab-pane fade" id="nav-recusados" role="tabpanel" aria-labelledby="recusados">
  <?php
  include 'database/conn.php';

  //Pedidos recusados---

  $sql="SELECT id, data, nome, de, ate, das, ashoras, observacoes, obsdiretor FROM pedidos WHERE id_utilizador='$_SESSION[id]' AND estado='2'";
  $result= mysqli_query($conn, $sql);
  echo "<table class='table table-hover'>";
  if(mysqli_num_rows($result) >0){
    while($row= mysqli_fetch_assoc($result)){

      echo "<tr><td><a href=index.php?page=5&ped=$row[id] class='text-primary'>".$row["nome"]."</a></td><td>".$row["de"]."</td><td>".$row["ate"]."</td><td>".$row["das"]."</td><td>".$row["ashoras"]."</td><td>".$row["data"]."</td></tr>";
    }
  }

  echo "</table>";
  include 'database/disc.php';
   ?>
 </div>
</div>

<?php
}else{

  echo 'Nao tem autorização para aceder a esta página!';
}
 ?>
</html>
